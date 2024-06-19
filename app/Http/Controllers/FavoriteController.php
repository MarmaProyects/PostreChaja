<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FavoriteController extends Controller
{
    public function add_removeFavorites($product_id)
    {
        try {
            $user = Auth::user();
            $isFavorite = $user->favorites()->where('product_id', $product_id)->exists();
            if ($isFavorite) {
                $user->favorites()->detach($product_id);
                return response()->json(['success' => true, 'message' => 'Producto eliminado de favoritos correctamente.'], 200);
            } else {
                $user->favorites()->attach($product_id);
                return response()->json(['success' => true, 'message' => 'Producto agregado a favoritos correctamente.'], 200);
            }
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'message' => 'Error al agregar/eliminar producto de favoritos.'], 500);
        }
    }
}
