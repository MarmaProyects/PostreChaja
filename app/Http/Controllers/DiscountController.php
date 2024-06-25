<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Discount;
use Illuminate\Http\Request;

class DiscountController extends Controller
{
    /**
     * Display a listing of the discounts.
     */
    public function index()
    {
        $discounts = Discount::query()->select('discounts.*')->paginate(10);
        return view('discounts.index', compact('discounts'));
    }

    /**
     * Show the form for creating a new discount.
     */
    public function create()
    {
        return view('discounts.create');
    }

    /**
     * Store a newly created discount in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'percentage' => 'nullable|numeric|min:0|max:100',
            'amount' => 'nullable|numeric|min:0',
            'description' => 'required|string|max:255',
        ]);

        $discount = new Discount();
        $discount->percentage = $request->input('percentage');
        $discount->amount = $request->input('amount');
        $discount->active = $request->has('active');
        $discount->description = $request->input('description');
        $discount->save();

        return redirect()->route('discounts.index')->with('success', 'Descuento creado exitosamente.');
    }

    /**
     * Show the form for editing the specified discount.
     */
    public function edit($id)
    {
        $discount = Discount::findOrFail($id);
        return view('discounts.edit', compact('discount'));
    }

    /**
     * Update the specified discount in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'percentage' => 'nullable|numeric|min:0|max:100',
            'amount' => 'nullable|numeric|min:0',
            'description' => 'required|string|max:255',
        ]);

        $discount = Discount::findOrFail($id);
        $discount->percentage = $request->input('percentage');
        $discount->amount = $request->input('amount');
        $discount->active = $request->has('active');
        $discount->description = $request->input('description');
        $discount->save();

        return redirect()->route('discounts.index')->with('success', 'Descuento actualizado exitosamente.');
    }

    /**
     * Remove the specified discount from storage.
     */
    public function destroy($id)
    {
        $discount = Discount::findOrFail($id);
        $discount->delete();

        return redirect()->route('discounts.index')->with('success', 'Descuento eliminado exitosamente.');
    }
}
