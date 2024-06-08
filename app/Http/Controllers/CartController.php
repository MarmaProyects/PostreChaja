<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function add(Request $request, $productId)
    {
        $cart = Session::get('cart', []);
        $quantity = $request->input('quantity', 1);

        if (isset($cart[$productId])) {
            $cart[$productId] += $quantity;
        } else {
            $cart[$productId] = $quantity;
        }

        Session::put('cart', $cart);
        return redirect()->route('carrito.index')->with('success', 'Producto añadido al carrito.');
    }

    public function index()
    {
        $products = Product::whereIn('id', array_keys(session('cart', [])))->get();
        $cart = session('cart', []);

        $total = 0;
        foreach ($products as $product) {
            $total += $product->price * $cart[$product->id];
        }

        return view('cart.index', compact('products', 'cart', 'total'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('cart.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Cart::create($request->all());
            return redirect()->route('cart.index');
        } catch (QueryException $e) {
            Log::error('Error creating cart: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error creating cart.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        return view('cart.edit', compact('cart'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        if ($request->action == 'increase') {
            session()->increment("cart.$id");
        } elseif ($request->action == 'decrease') {
            session()->decrement("cart.$id");
        }

        return redirect()->route('carrito.index')->with('success', 'Carrito actualizado.');
    }

    public function remove($productId)
    {
        $cart = Session::get('cart', []);

        if (isset($cart[$productId])) {
            unset($cart[$productId]);
            Session::put('cart', $cart);
            return response()->json(['success' => true, 'message' => 'Producto eliminado del carrito.']);
        }

        return response()->json(['success' => false, 'message' => 'El producto no se encontró en el carrito.']);
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect()->route('carrito.index');
    }
}
