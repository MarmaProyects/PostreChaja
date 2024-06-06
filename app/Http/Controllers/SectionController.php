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
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Section::create($request->all());
        } catch (QueryException $e) {
            Log::error('Error creating Section: ' . $e->getMessage());
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
    public function edit(Section $section)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Section $section)
    {
        try {
            $section->update($request->all());
        } catch (QueryException $e) {
            Log::error('Error Updating Section: ' . $e->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        $section->delete();
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
