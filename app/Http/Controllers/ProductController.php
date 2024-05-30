<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Section;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $productsQuery = Product::query()->select('products.*', 'products.name as product_name');

        $categories = Category::all();
        $sections = Section::all();

        $search = $request->input('search');
        if ($search) {
            $searchTerm = strtolower($search);
            $productsQuery->where(function ($query) use ($searchTerm) {
                $query->whereRaw('LOWER(products.name) LIKE ?', ['%' . $searchTerm . '%'])
                    ->orWhereRaw('LOWER(products.description) LIKE ?', ['%' . $searchTerm . '%']);
            });
        }

        $categoryFilter = $request->input('categories', []);
        if (!empty($categoryFilter)) {
            $productsQuery->whereIn('category_id', $categoryFilter);
        }

        $sectionFilter = $request->input('sections', []);
        if (!empty($sectionFilter)) {
            $productsQuery->whereIn('section_id', $sectionFilter);
        }

        $order = $request->input('order', 'created_at_desc');
        switch ($order) {
            case 'price_asc':
                $productsQuery->orderBy('price');
                break;
            case 'price_desc':
                $productsQuery->orderByDesc('price');
                break;
            case 'created_at_desc':
                $productsQuery->orderByDesc('created_at');
                break;
            case 'category_asc':
                $productsQuery->leftJoin('categories', 'products.category_id', '=', 'categories.id')
                    ->orderBy('categories.name');
                break;
            default:
                $productsQuery->orderByDesc('created_at');
                break;
        }

        $products = $productsQuery->get();
        return view('products.index', compact('products', 'categories', 'sections'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('products.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            Product::create($request->all());
            return redirect()->route('products.index');
        } catch (QueryException $e) {
            Log::error('Error creating Product: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error creating client.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $product = Product::findOrFail($id);
            return view('products.show', compact('product'));
        } catch (\Exception $e) {
            Log::error('Error showing Product: ' . $e->getMessage());
            return redirect()->route('products.index')->with('error', 'Product not found.');
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        try {
            $product->update($request->all());
            return redirect()->route('products.index');
        } catch (QueryException $e) {
            Log::error('Error Updating Product: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error updating client.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect()->route('products.index');
    }
}
