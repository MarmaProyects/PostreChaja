<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Cart;
use App\Models\Discount;
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
        $this->updateCartTotal($cart);
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
        $this->updateCartTotal($cart);
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
            $item->description = $product->description;
            $item->category_id = $product->category_id;
            $item->unit_price = $product->price;
            $items[] = $item;
        }
        $user = Auth::user();
        $client = new PreferenceClient();

        $payer = array(
            "name" => $user->client->fullname,
            "surname" => '',
            "email" => $user->email,
            "addres" => [
                "street_name" => $user->client->address,
            ],
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
        $starsEarned = floor($cart->final_price / 100);
        $user = Auth::user();
        $client = $user->client;
        $client->total_stars += $starsEarned;
        $client->available_stars += $starsEarned;
        $client->save();
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

    public function applyDiscount(Request $request)
    {
        $request->validate([
            'coupon_code' => 'nullable|string|exists:discounts,code',
            'stars' => 'nullable|integer|min:0|max:' . Auth::user()->client->available_stars,
        ]);

        $cart = $this->getCurrentCartModel();
        $this->updateCartTotal($cart);
        $totalPrice = $cart->final_price;

        if ($request->has('coupon_code')) {
            $discount = Discount::where('id', $request->input('coupon_code'))->first();
            if ($discount) {
                if ($discount->percentage) {
                    $totalPrice -= ($totalPrice * ($discount->percentage / 100));
                } else {
                    $totalPrice -= $discount->amount;
                }
            }
        }

        if ($request->has('stars')) {
            $stars = $request->input('stars');
            $discountFromStars = $stars * 1;
            $totalPrice -= $discountFromStars;

            $user = Auth::user();
            $user->client->available_stars -= $stars;
            $user->client->save();
        }

        $cart->final_price = max($totalPrice, 0);
        $cart->save();

        return redirect()->route('cart.index')->with('success', 'Descuentos aplicados exitosamente.');
    }
}
