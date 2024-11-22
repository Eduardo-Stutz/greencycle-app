<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

Route::get('/', [ProductController::class, 'index']);
Route::get('/products/create ', [ProductController::class, 'create'])->middleware('auth');
Route::get('/products/{id} ', [ProductController::class, 'show']);

// Rota formulário
Route::post('/products', [ProductController::class, 'store']);
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->middleware('auth');
Route::get('/products/edit/{id}',[ProductController::class,'edit'])->middleware('auth');
Route::put('products/update/{id}', [ProductController::class,'update'])->middleware('auth');

Route::get('/dashboard',[ProductController::class,'dashboard'])->middleware('auth');

Route::post('/products/join/{id}', [ProductController::class, 'joinProduct'])->middleware('auth');

Route::delete('/products/leave/{id}', [ProductController::class, 'leaveProduct'])->middleware('auth');

