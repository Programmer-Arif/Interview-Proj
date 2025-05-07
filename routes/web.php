<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::view('product','product');
Route::view('create','create');
Route::view('edit','edit');

Route::resource('products',ProductController::class);