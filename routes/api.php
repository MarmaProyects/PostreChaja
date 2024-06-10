<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\SectionController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ClientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/productos', [ProductController::class,'API_get']);
Route::get('/secciones', [SectionController::class,'API_get']);
Route::get('/categorias', [CategoryController::class,'API_get']);
Route::get('/clientes', [ClientController::class,'API_get']);
