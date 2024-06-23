<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\Client;
use App\Models\User;
use Doctrine\DBAL\Query\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\View\View;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        $user = Auth::user();
        $client = Client::findByUserId($user->id);
        return view('profile.edit', compact('client', 'user'));
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request, int $id): RedirectResponse
    {
        $client = Client::findOrFail($id);  
        $user = $client->user;

        $request->validate([
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'], 
        ]);
        try {
            $userData = $request->only('email');
            $clientData = $request->only('fullname'); 
            if ($request->filled('address')) {
                $clientData['address'] = $request->input('address');
            }
            if ($request->filled('phone')) {
                $clientData['phone'] = $request->input('phone');
            }
            $user->update($userData);
            $client->update($clientData);
            return redirect()->route('perfil.edit')->with('success', 'Información actualizada!');
        } catch (QueryException $e) {
            Log::error('Error Updating category: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al editar!');
        }
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}