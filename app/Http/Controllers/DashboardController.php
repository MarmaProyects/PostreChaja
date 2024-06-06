<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;

class DashboardController extends Controller
{
    public function index()
    {
        $products_visit = Product::orderBy('visits', 'desc')->take(10)->get();
        $products_visit = $products_visit->sortByDesc('visits');
        $categories_with_products = Category::withCount('products')->get();

        return view('dashboard', compact('products_visit', 'categories_with_products'));
    }
}
