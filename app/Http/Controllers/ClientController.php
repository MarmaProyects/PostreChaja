<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\User;
use Illuminate\Auth\Events\Registered;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $clients = Client::query()->select('clients.*')->paginate(10);
        return view('clients.index', compact('clients'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('clients.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\password::defaults()],
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
        return redirect()->route('clientes.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Client $client)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $client = Client::findOrFail($id);
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $client = Client::findOrFail($id);
        $user = $client->user;

        $request->validate([
            'fullname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'phone' => ['nullable', 'string', 'max:20'],
            'address' => ['nullable', 'string', 'max:255'],
            'password' => ['nullable', 'string', 'min:8', 'confirmed']
        ]);

        try {
            $userData = $request->only('email');
            $clientData = $request->only('fullname');
            if ($request->filled('password')) {
                $userData['password'] = Hash::make($request->input('password'));
            }
            if ($request->filled('address')) {
                $clientData['address'] = $request->input('address');
            }
            if ($request->filled('phone')) {
                $clientData['phone'] = $request->input('phone');
            }
            $user->update($userData);
            $client->update($clientData);
            return redirect()->route('clientes.index')->with('success', 'Cliente actualizado exitosamente.');
        } catch (QueryException $e) {
            Log::error('Error Updating category: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al editar el cliente.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $client_id)
    {
        try {
            $client = Client::find($client_id);
            User::destroy($client->user_id);
            Client::destroy($client_id);
            return redirect()->route('clientes.index')->with('success', 'Cliente eliminado satisfactoriamente.');
        } catch (QueryException $e) {
            Log::error('Error deleting Category: ' . $e->getMessage());
            if ($e->getCode() == '23503') {
                return redirect()->route('clientes.index')->with('error', 'Este cliente no pudo ser eliminado.');
            }
            return redirect()->route('clientes.index')->with('error', 'Fallo en la eliminación.');
        }
    }

    public function API_get()
    {
        $clientes = Client::with('user')->get();
        if ($clientes->isEmpty()) {
            return response()->json(['message' => 'No hay clientes registrados'], 200);
        }
        return response()->json($clientes, 200);
    }
}
