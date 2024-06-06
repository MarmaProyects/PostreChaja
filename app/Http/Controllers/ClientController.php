<?php

namespace App\Http\Controllers;

use App\Models\Client;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Database\QueryException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;

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
        try {
            Client::create($request->all());
            return redirect()->route('clients.index');
        } catch (QueryException $e) {
            Log::error('Error creating client: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error creating client.');
        }
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
    public function edit(Client $client)
    {
        return view('clients.edit', compact('client'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Client $client)
    {
        try {
            $client->update($request->all());
        } catch (QueryException $e) {
            Log::error('Error creating client: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error updating client.');
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
}
