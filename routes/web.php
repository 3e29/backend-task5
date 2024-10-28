<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Auth;
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
Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::group(['middleware' => ['auth', 'admin']],function () {
    Route::resource('/products', ProductController::class);
    Route::resource('/categories', CategoryController::class);
    Route::get('/orders', [OrderController::class, 'index']);
    Route::post('/products/{id}/restore', [ProductController::class, 'restore'])->name('products.restore');
});

Route::get('/dashboard', [DashboardController::class, 'index'])->middleware('auth');