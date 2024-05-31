<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\IndexController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SectionController;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('index');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified', 'role:Admin'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/perfil', [ProfileController::class, 'edit'])->name('perfil.edit');
    Route::patch('/perfil', [ProfileController::class, 'update'])->name('perfil.update');
    Route::delete('/perfil', [ProfileController::class, 'destroy'])->name('perfil.destroy');
});

Route::middleware(['auth', 'verified', 'role:Admin'])->group(function () {
    Route::get('/dashboard/products', [ProductController::class, 'table'])->name('products.table');
});

Route::resource('clientes', ClientController::class);
Route::resource('productos', ProductController::class);
Route::resource('sections', SectionController::class);
Route::resource('category', CategoryController::class);

require __DIR__ . '/auth.php';
