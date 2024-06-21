<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cart;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use MercadoPago\MercadoPagoConfig;
use MercadoPago\Client\Preference\PreferenceClient;
use MercadoPago\Exceptions\MPApiException;
use MercadoPago\Resources\Preference\Item;

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

    private function getCurrentCartModel()
    {
        if (Auth::check()) {
            $cart = Cart::where('user_id', Auth::id())->active()->first();
            if (!$cart) {
                $cart = Cart::create([
                    'user_id' => Auth::id(),
                    'status' => 'active',
                    'final_price' => 0,
                ]);
            }
        } else {
            $this->createGuestUser();
            $guestUserId = session('guest_user_id');
            $cart = Cart::where('user_id', $guestUserId)->where('status', 'active')->first();
            if (!$cart) {
                $cart = Cart::create([
                    'user_id' => $guestUserId,
                    'status' => 'active',
                    'final_price' => 0,
                ]);
            }
        }
        return $cart;
    }
    public function historial()
    {
        $user = Auth::user();
        $completedCarts = $user->carts()->completed()->get();

        return view('cart.historial', compact('completedCarts'));
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

    public function checkout()
    {
        $cart = $this->getCurrentCartModel();
        $preferencia = $this->crearPreferencia($cart);
        if ($preferencia) {
            $init_point = $preferencia->init_point;
            return redirect($init_point);
        } else {
            return redirect()->back()->with('error', 'No se pudo crear la preferencia de pago.');
        }
    }

    private function crearPreferencia(Cart $cart)
    {
        MercadoPagoConfig::setAccessToken(env('MERCADOPAGO_ACCESS_TOKEN'));
        $preference = new PreferenceClient();
        $items = [];
        foreach ($cart->products as $product) {
            $item = new Item();
            $item->id = $product->id;
            $item->title = $product->name;
            $item->quantity = $product->pivot->quantity;
            $item->unit_price = $product->price;
            $items[] = $item;
        }
        $user = Auth::user();
        $client = new PreferenceClient();

        $payer = array(
            "name" => $user->name,
            "surname" => $user->surname,
            "email" => $user->email,
        );
        $request = $this->createPreferenceRequest($items, $payer);

        try {
            $preference = $client->create($request);
            return $preference;
        } catch (MPApiException $error) {
            return null;
        }
    }

    function createPreferenceRequest($items, $payer): array
    {
        $paymentMethods = [
            "excluded_payment_methods" => [],
            "installments" => 12,
            "default_installments" => 1
        ];

        $backUrls = array(
            'success' => route('mercadopago.success'),
            'failure' => route('mercadopago.failed')
        );

        $request = [
            "items" => $items,
            "payer" => $payer,
            "payment_methods" => $paymentMethods,
            "back_urls" => $backUrls,
            "statement_descriptor" => "NAME_DISPLAYED_IN_USER_BILLING",
            "external_reference" => "1234567890",
            "expires" => false,
            "auto_return" => 'approved',
        ];

        return $request;
    }

    public function success()
    {
        $cart = $this->getCurrentCartModel();
        $cart->status = 'completed';
        $cart->save();
        return view('cart.success');
    }

    public function failed()
    {
        return view('cart.failed');
    }

    public function pending()
    {
        return view('cart.pending');
    }
}
