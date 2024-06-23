<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;
use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Image;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $price = $request->input('price', 1500);
        if ($price != 1500) {
            $productsQuery->where('price', '<=', $price);
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

    public function table(Request $request)
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

        $products = $productsQuery->paginate(10);
        return view('products.table', compact('products', 'categories', 'sections'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $sections = Section::all();
        $categories = Category::all();
        return view('products.create', compact('sections', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'description' => 'required|string',
            'amount' => 'required|integer',
            'category_id' => 'required|string',
            'section_id' => 'required|string',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        try {
            $product = Product::create([
                'name' => $request['name'],
                'price' => $request['price'],
                'description' => $request['description'],
                'amount' => $request['amount'],
                'category_id' => $request['category_id'],
                'section_id' => $request['section_id'],
            ]);
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $product->images()->create(['base64' => base64_encode(file_get_contents($image))]);
                }
            }

            return redirect()->route('productos.table')->with('success', 'Producto creado exitosamente.');
        } catch (QueryException $e) {
            Log::error('Error creando el producto: ' . $e->getMessage() . ' : ' . $request['section_id']);
            return redirect()->back()->with('error', 'Error creando el producto.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        try {
            $product = Product::with(['section', 'category'])->findOrFail($id);
            $product->increment('visits');
            $isFavorite = false;
            if (Auth::check()) {
                $user = Auth::user();
                $isFavorite = $user->favorites()->where('product_id', $product->id)->exists();
            }

            $productName = strtolower($product->name);
            $productSection = strtolower($product->section->name);
            $productCategory = strtolower($product->category->name);
            $productsQuery = Product::query();

            $productsQuery->where(function ($query) use ($productName, $productSection, $productCategory) {
                $query->whereRaw('LOWER(name) LIKE ?', ['%' . $productName . '%'])
                    ->orWhereRaw('LOWER(description) LIKE ?', ['%' . $productName . '%'])
                    ->orWhereHas('section', function ($q) use ($productSection) {
                        $q->whereRaw('LOWER(name) LIKE ?', ['%' . $productSection . '%']);
                    })
                    ->orWhereHas('category', function ($q) use ($productCategory) {
                        $q->whereRaw('LOWER(name) LIKE ?', ['%' . $productCategory . '%']);
                    });
            });
            $productsQuery->where('id', '!=', $id);
            $products = $productsQuery->get();
            return view('products.show', compact('product', 'products', 'isFavorite'));
        } catch (\Exception $e) {
            Log::error('Error showing Product: ' . $e->getMessage());
            return redirect()->route('productos.index')->with('error', 'Product not found.');
        }
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $product = Product::findOrFail($id);
        $sections = Section::all();
        $categories = Category::all();
        return view('products.edit', compact('product', 'sections', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, int $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'price' => 'required|numeric',
            'amount' => 'required|integer',
            'description' => 'required|string',
            'section_id' => 'required|exists:sections,id',
            'category_id' => 'required|exists:categories,id',
            'images.*' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        try {
            $product = Product::findOrFail($id);
            $product->update($request->only('name', 'price', 'amount', 'description', 'section_id', 'category_id'));
            if ($request->hasFile('images')) {
                foreach ($request->file('images') as $image) {
                    $product->images()->create(['base64' => base64_encode(file_get_contents($image))]);
                }
            }
            return redirect()->route('productos.table')->with('success', 'Producto actualizado exitosamente.');
        } catch (QueryException $e) {
            Log::error('Error Updating Product: ' . $e->getMessage());
            return redirect()->back()->with('error', 'Error updating product.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(int $product_id)
    {
        $deleted = Product::destroy($product_id);
        if ($deleted) {
            return back()->with('success', 'Producto eliminado satisfactoriamente.');
        } else {
            return back()->with('error', 'Fallo en la eliminación.');
        }
    }

    public function mostVisitedProducts()
    {
        $products = Product::orderBy('visits', 'desc')->take(10)->get();

        return $products;
    }

    public function API_get()
    {
        $productos = Product::with(['images' => function ($query) {
            $query->limit(1); 
        }])->get();
        if ($productos->isEmpty()) {
            return response()->json(['message' => 'No hay productos registrados'], 200);
        }
        return response()->json($productos, 200);
    }
}
