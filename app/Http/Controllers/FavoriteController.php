<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function add_removeFavorites($product_id, Request $request)
    {
        try {
            $user = Auth::user();
            $isFavorite = $user->favorites()->where('product_id', $product_id)->exists();
            if ($request->ajax()) {
                if ($isFavorite) {
                    $user->favorites()->detach($product_id);
                    return response()->json(['success' => true, 'message' => 'Producto eliminado de favoritos correctamente.'], 200);
                } else {
                    $user->favorites()->attach($product_id);
                    return response()->json(['success' => true, 'message' => 'Producto agregado a favoritos correctamente.'], 200);
                }
            } else {
                if ($isFavorite) {
                    $user->favorites()->detach($product_id);
                } else {
                    $user->favorites()->attach($product_id);
                }
                return redirect()->back();
            }
        } catch (\Exception $e) {
            if ($request->ajax()) {
                return response()->json(['success' => false, 'message' => 'Error al agregar/eliminar producto de favoritos.'], 500);
            } else {
                return redirect()->back()->with('error', 'Error al agregar/eliminar producto de favoritos.');
            }
        }
    }

    public function show()
    {
        $user = Auth::user();
        $products = $user->favorites()->get();
        return view('products.favorites', compact('products'));
    }
}
