<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FavoriteController;
use App\Http\Controllers\ImagesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Route;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

Route::get('/login', function () {
    return redirect('/ingreso');
})->name('login');

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'role:Admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::post('/product/{product}/favorite', [FavoriteController::class, 'add_removeFavorites'])->name('productos.add_removeFavorite');
    Route::get('/favoritos', [FavoriteController::class, 'show'])->name('favoritos');
    Route::get('/perfil', [ProfileController::class, 'edit'])->name('perfil.edit');
    Route::put('/perfil/{id}', [ProfileController::class, 'update'])->name('perfil.update');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('perfil.destroy');
});

Route::middleware(['auth', 'verified', 'role:Admin'])->group(function () { 
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('/dashboard/clientes', ClientController::class);
    Route::resource('/dashboard/secciones', SectionController::class);
    Route::resource('/dashboard/categorias', CategoryController::class);
    Route::get('/dashboard/productos', [ProductController::class, 'table'])->name('productos.table'); 
    Route::post('/dashboard/productos', [ProductController::class, 'store'])->name('productos.store'); 
    Route::get('/dashboard/productos/{id}/edit', [ProductController::class, 'edit'])->name('productos.edit'); 
    Route::put('/dashboard/productos/{id}', [ProductController::class, 'update'])->name('productos.update'); 
    Route::get('/dashboard/productos/create', [ProductController::class, 'create'])->name('productos.create'); 
    Route::delete('/dashboard/productos/{product}', [ProductController::class, 'destroy'])->name('productos.destroy');
    Route::delete('/images/{image}', [ImagesController::class, 'destroy'])->name('images.destroy');
});

Route::get('/productos', [ProductController::class, 'index'])->name('productos.index');
Route::get('/productos/{id}', [ProductController::class, 'show'])->name('productos.show');
  
Route::resource('carrito', CartController::class);
Route::post('/carrito/add', [CartController::class, 'add'])->name('carrito.add');
Route::delete('/carrito/remove/{product}', [CartController::class, 'remove'])->name('carrito.remove');
Route::post('/carrito/update/{product}', [CartController::class, 'update'])->name('carrito.update'); 
Route::get('/historial', [CartController::class, 'historial'])->name('carrito.historial');
Route::post('/checkout', [CartController::class, 'checkout'])->name('carrito.checkout');

Route::fallback(function () {
    return redirect('/');
}); 

require __DIR__ . '/auth.php';
