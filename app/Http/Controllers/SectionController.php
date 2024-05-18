<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\Http\Controllers\Controller;
use Doctrine\DBAL\Query\QueryException;
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
            return redirect()->route('sections.index');
        } catch (QueryException $e) {
            Log::error('Error creating Section: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error creating section.');
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
            return redirect()->route('sections.index');
        } catch (QueryException $e) {
            Log::error('Error Updating Section: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error updating section.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Section $section)
    {
        $section->delete();
        return redirect()->route('sections.index');
    }
}
