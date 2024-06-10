<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Http\Controllers\Controller;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class SectionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $sections = Section::query()->select('sections.*')->paginate(10);
        return view('sections.index', compact('sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('sections.create');
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
            Section::create([
                'name' => $request['name'],
            ]);
            return redirect()->route('secciones.index')->with('success', 'Sección creada exitosamente.');
        } catch (QueryException $e) {
            Log::error('Error creating Section: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error creando la sección.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Section $section)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $section = Section::findOrFail($id);
        return view('sections.edit', compact('section'));
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
            $section = Section::findOrFail($id);
            $section->update($request->only('name'));
            return redirect()->route('secciones.index')->with('success', 'Sección actualizada exitosamente.');
        } catch (QueryException $e) {
            Log::error('Error Updating category: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error al editar la sección.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $section_id)
    {
        try {
            Section::destroy($section_id);
            return redirect()->route('secciones.index')->with('success', 'Sección eliminada satisfactoriamente.');
        } catch (QueryException $e) {
            Log::error('Error deleting Category: ' . $e->getMessage());
            if ($e->getCode() == '23503') {
                return redirect()->route('secciones.index')->with('error', 'Esta sección tiene productos asociados aun.');
            }
            return redirect()->route('secciones.index')->with('error', 'Fallo en la eliminación.');
        }
    }

    public function API_get()
    {
        $seccion = Section::withCount('products')->get();
        if($seccion->isEmpty()) {
            return response()->json(['message' => 'No hay secciones registradas'], 200);
        }
        return response()->json($seccion, 200);
    }
}
