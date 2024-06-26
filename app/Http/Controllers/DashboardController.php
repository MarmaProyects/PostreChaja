<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Category;
use App\Models\Client;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $products_visit = Product::orderBy('visits', 'desc')->take(10)->get();
        $products_visit = $products_visit->sortByDesc('visits');
        $categories_with_products = Category::withCount('products')->get();
        $products_favorites = Product::withCount('favorites')->orderByDesc('favorites_count')->take(5)->get();

        $monthly_data = Cart::select(
            DB::raw('COUNT(*) as total_purchases'),
            DB::raw('SUM(carts.final_price) as total_revenue'),
            DB::raw("TO_CHAR(carts.created_at, 'YYYY-MM') as month")
        )
            ->where('status', 'completed')
            ->groupBy('month')
            ->orderBy('month')
            ->get();

        $products_sold = Product::select('products.id', 'products.name', DB::raw('SUM(cart_product.quantity) as total_sold'))
            ->join('cart_product', 'products.id', '=', 'cart_product.product_id')
            ->groupBy('products.id', 'products.name')
            ->orderByDesc('total_sold')
            ->take(10)
            ->get();

        $clients_with_stars = Client::select('clients.id', 'clients.fullname', 'clients.total_stars')
            ->orderByDesc('total_stars')
            ->take(10)
            ->get();

        return view('dashboard', compact('products_visit', 'categories_with_products', 'products_favorites', 'monthly_data', 'products_sold', 'clients_with_stars'));
    }
}
