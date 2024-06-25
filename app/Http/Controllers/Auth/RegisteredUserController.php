<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\User;
use App\Models\Client;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $user = User::create([
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        $client = new Client([
            'fullname' => $request->name,
            'phone' => $request->phone,
            'address' => "",
            'total_stars' => 0,
            'available_stars' => 0,
            'notifications' => false,
        ]);

        $user->client()->save($client);
        $user->assignRole('Cliente');

        event(new Registered($user));

        Auth::login($user);

        $this->transferGuestCartToUser($user);

        return redirect(route('index', absolute: false));
    }

    protected function transferGuestCartToUser($user)
    {
        $guestCart = Cart::where('user_id', session('guest_user_id'))->first();
        if ($guestCart) {
            $guestCart->user_id = $user->id;
            $guestCart->save();
        }

        session()->forget('guest_user_id');
    }
}
