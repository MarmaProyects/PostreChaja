<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::query()->select('categories.*')->paginate(10);
        return view('categories.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('categories.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);

        try {
            Category::create([
                'name' => $request['name'],
            ]);
            return redirect()->route('categorias.index')->with('success', 'Categoria creada exitosamente.');
        } catch (QueryException $e) {
            Log::error('Error creando la categoria: ' . $e->getMessage() . ' : ' . $request['section_id']);
            return redirect()->back()->with('error', 'Error creando la categoría.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
        ]);
        try { 
            $category = Category::findOrFail($id);
            $category->update($request->only('name'));
            return redirect()->route('categorias.index')->with('success', 'Categoría actualizada exitosamente.');
        } catch (QueryException $e) {
            Log::error('Error Updating category: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al editar la categoría.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $category_id)
    {
        try {
            Category::destroy($category_id);
            return redirect()->route('categorias.index')->with('success', 'Categoría eliminada satisfactoriamente.');
        } catch (QueryException $e) {
            Log::error('Error deleting Category: ' . $e->getMessage());
            if ($e->getCode() == '23503') {
                return redirect()->route('categorias.index')->with('error', 'Esta categoría tiene productos asociados aun.');
            }
            return redirect()->route('categorias.index')->with('error', 'Fallo en la eliminación.');
        }
    }

    public function API_get()
    {
        $categoria = Category::withCount('products')->get();
        if($categoria->isEmpty()) {
            return response()->json(['message' => 'No hay categorias registradas'], 200);
        }
        return response()->json($categoria, 200);
    }
}
