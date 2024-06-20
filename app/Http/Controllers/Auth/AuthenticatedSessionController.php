<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\Cart;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        return view('auth.ingreso');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();

        $request->session()->regenerate();
        $this->transferGuestCartToUser(Auth::user());

        return redirect()->intended(route('index', absolute: false));
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');
    }

    protected function transferGuestCartToUser($user)
    {
        $guestCart = Cart::where('user_id', session('guest_user_id'))->first();
        if ($guestCart) {
            $userCart = Cart::where('user_id', $user->id)->where('status', 'active')->first();

            if ($userCart) {
                foreach ($guestCart->products as $product) {
                    $existingProduct = $userCart->products()->where('product_id', $product->id)->first();
                    if ($existingProduct) {
                        $userCart->products()->updateExistingPivot($product->id, ['quantity' => $existingProduct->pivot->quantity + $product->pivot->quantity]);
                    } else {
                        $userCart->products()->attach($product->id, ['quantity' => $product->pivot->quantity]);
                    }
                }
                $guestCart->status = 'inactive';
                $guestCart->save();
            } else {
                $guestCart->user_id = $user->id;
                $guestCart->save();
            }
        }

        session()->forget('guest_user_id');
    }
}
