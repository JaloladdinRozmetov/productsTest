<?php

use App\Http\Controllers\AuthLoginRegisterController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::controller(AuthLoginRegisterController::class)->group(function() {
    Route::get('/register', 'register')->name('register');
    Route::post('/store', 'store')->name('store');
    Route::get('/login', 'login')->name('login');
    Route::post('/authenticate', 'authenticate')->name('authenticate');
    Route::get('/', 'dashboard')->name('dashboard');
    Route::get('/logout', 'logout')->name('logout');
});

Route::get('/products', [ProductController::class, 'index'])->middleware('auth')->name('products.index');
Route::get('/products/create', [ProductController::class, 'create'])->middleware('auth')->name('products.create');
Route::post('/products', [ProductController::class, 'store'])->middleware('auth')->name('products.store');
Route::get('/products/{product}', [ProductController::class, 'show'])->middleware('auth')->name('products.show');
Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->middleware('auth')->name('products.edit');
Route::post('/products/{product}', [ProductController::class, 'update'])->middleware('auth')->name('products.update');
Route::delete('/products/{product}', [ProductController::class, 'destroy'])->middleware('auth')->name('products.destroy');
