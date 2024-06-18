<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class CartController extends Controller
{
    public function add(Request $request)
    {
        $quantity = $request->input('quantity', 1);
        $productId = $request->input('productId', 1);

        $cartModel = $this->getCurrentCartModel();
        $existingProduct = $cartModel->products()->where('product_id', $productId)->first();
        if ($existingProduct) {
            $cartModel->products()->updateExistingPivot($productId, [
                'quantity' => $existingProduct->pivot->quantity + $quantity,
            ]);
        } else {
            $cartModel->products()->attach($productId, ['quantity' => $quantity]);
        }

        $this->updateCartTotal($cartModel);
        return redirect()->back()->with('success', 'Producto añadido al carrito.');
    }

    public function index()
    {
        $cart = $this->getCurrentCartModel();
        $products = $cart->products;
        $total = $cart->final_price;

        return view('cart.index', compact('cart', 'products', 'total'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $productId)
    {
        $action = $request->input('action');

        if ($action === 'increase') {
            $this->incrementProduct($productId);
        } elseif ($action === 'decrease') {
            $this->decrementProduct($productId);
        }

        return redirect()->back();
    }

    public function remove($productId)
    {
        $cartModel = $this->getCurrentCartModel();

        $cartModel->products()->detach($productId);
        $this->updateCartTotal($cartModel);

        return redirect()->back()->with('success', 'Producto eliminado del carrito.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        $cart->delete();
        return redirect()->route('carrito.index');
    }

    private function getCurrentCart()
    {
        if (Auth::check()) {
            $user = Auth::user();
            $cartModel = Cart::firstOrCreate(
                ['user_id' => $user->id, 'status' => 'active'],
                ['final_price' => 0]
            );
            $cart = $cartModel->products->pluck('pivot.quantity', 'id')->toArray();
        } else {
            $this->createGuestUser();
            $cartModel = Cart::firstOrCreate(
                ['user_id' => session('guest_user_id'), 'status' => 'active'],
                ['final_price' => 0]
            );
            $cart = $cartModel->products->pluck('pivot.quantity', 'id')->toArray();
        }

        return $cart;
    }

    private function saveCart($cart)
    {
        $user = Auth::user();
        $cartModel = Cart::firstOrCreate(
            ['user_id' => $user->id, 'status' => 'active'],
            ['final_price' => 0]
        );

        $total = 0;

        foreach ($cart as $productId => $quantity) {
            $product = Product::find($productId);
            if ($product) {
                $total += $product->price * $quantity;
            }
        }

        $cartModel->final_price = $total;
        $cartModel->save();
        $cartModel->products()->sync($cart);
    }
    public function checkout(Request $request)
    {
        $cart = $this->getCurrentCartModel();

        // Lógica para procesar el pago...

        // Si el pago es exitoso:
        $cart->status = 'completed';
        $cart->save();

        // Crear un nuevo carrito activo para el usuario
        $newCart = Cart::create([
            'user_id' => Auth::id(),
            'final_price' => 0,
            'status' => 'active'
        ]);

        return redirect()->route('carrito.index')->with('success', 'Compra completada exitosamente.');
    }

    private function getCurrentCartModel()
    {
        if (Auth::check()) {
            return Cart::where('user_id', Auth::id())->active()->first();
        } else {
            $this->createGuestUser();
            return Cart::firstOrCreate(
                ['user_id' => session('guest_user_id'), 'status' => 'active'],
                ['final_price' => 0]
            );
        }
    }
    public function historial()
    {
        $user = Auth::user();
        $completedCarts = $user->carts()->completed()->get();

        return view('carrito.historial', compact('completedCarts'));
    }
    private function updateCartTotal($cartModel)
    {
        $total = $cartModel->products->sum(function ($product) {
            return $product->price * $product->pivot->quantity;
        });

        $cartModel->final_price = $total;
        $cartModel->save();
    }

    private function incrementProduct(int $id)
    {
        $cart = $this->getCurrentCartModel();
        $cartProduct = $cart->products()->where('product_id', $id)->first();

        if ($cartProduct) {
            $cartProduct->pivot->quantity += 1;
            $cartProduct->pivot->save();
        } else {
            $cart->products()->attach($id, ['quantity' => 1]);
        }
    }

    private function decrementProduct(int $id)
    {
        $cart = $this->getCurrentCartModel();
        $cartProduct = $cart->products()->where('product_id', $id)->first();

        if ($cartProduct) {
            if ($cartProduct->pivot->quantity > 1) {
                $cartProduct->pivot->quantity -= 1;
                $cartProduct->pivot->save();
            } else {
                $cart->products()->detach($id);
            }
        }
    }

    public function createGuestUser()
    {
        if (!session()->has('guest_user_id')) {
            $guestUser = User::create([
                'email' => 'guest' . uniqid() . '@example.com',
                'is_guest' => true,
                'password' => 1
            ]);

            session(['guest_user_id' => $guestUser->id]);
        }
    }
}
