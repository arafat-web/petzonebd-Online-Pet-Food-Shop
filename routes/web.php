<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\LogoutController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
//Client Routing
Route::get('/', [ClientController::class, 'index'])->name('index');
Route::get('/product/{cat_id}/{id}', [ClientController::class, 'product'])->name('product');
Route::get('/products/{id}', [ClientController::class, 'allProduct'])->name('products');

//Cart
Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');

Route::middleware(['auth:sanctum', config('jetstream.auth_session'), 'verified'])->group(function () {
//Admin Routing
    Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/manage-categories', [CategoryController::class, 'manageCategory'])->name('manage.categories');
    Route::post('/add-category', [CategoryController::class, 'addCategory'])->name('add.category');
    Route::get('/delete-category/{id}', [CategoryController::class, 'deleteCategory'])->name('delete.category');
    Route::get('/manage-categories/edit/{id}', [CategoryController::class, 'editCategory'])->name('edit.category');
    Route::post('/update-category', [CategoryController::class, 'updateCategory'])->name('update.category');

    Route::get('/add-product', [ProductController::class, 'addProduct'])->name('add.product');
    Route::post('/save-product', [ProductController::class, 'saveProduct'])->name('save.product');
    Route::get('/manage-products', [ProductController::class, 'manageProduct'])->name('manage.products');
    Route::get('/delete-product/{id}', [ProductController::class, 'deleteProduct'])->name('delete.product');
    Route::get('/logout', [LogoutController::class, 'logoutUser'])->name('log.out');

});
