<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\SalesController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\Auth\AdminAuthenticatedSessionController;
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
Route::get('/product/{category}/{product}', [ClientController::class, 'product'])->name('product');
Route::get('/products/{category}', [ClientController::class, 'allProduct'])->name('products');
Route::get('/search', [ClientController::class, 'search'])->name('search');

// Contact
Route::get('contact', [ContactController::class, 'show'])->name('contact.show');
Route::post('contact', [ContactController::class, 'send'])->name('contact.send');

//Client Auth
Route::middleware('guest')->group(function () {
    Route::get('login', function() { return view('client.auth.login'); })->name('client.login');
    Route::post('login', [App\Http\Controllers\Auth\AuthenticatedSessionController::class, 'store'])->name('login');
    
    Route::get('register', function() { return view('client.auth.register'); })->name('client.register');
    Route::post('register', [\Laravel\Fortify\Http\Controllers\RegisteredUserController::class, 'store'])->name('register');
});

// Admin Auth
Route::middleware('guest')->group(function () {
    Route::get('admin-login', [AdminAuthenticatedSessionController::class, 'create'])->name('admin.login');
    Route::post('admin-login', [AdminAuthenticatedSessionController::class, 'store'])->name('admin.login.store');
});

Route::post('logout', [\Laravel\Fortify\Http\Controllers\AuthenticatedSessionController::class, 'destroy'])->name('logout');
Route::post('admin-logout', [AdminAuthenticatedSessionController::class, 'destroy'])->name('admin.logout');

//User Panel (Authenticated Clients)
Route::middleware('auth')->group(function () {
    Route::get('my-dashboard', [UserController::class, 'dashboard'])->name('user.dashboard');
    Route::get('profile', [UserController::class, 'profile'])->name('user.profile');
    Route::post('profile/update', [UserController::class, 'updateProfile'])->name('user.update-profile');
    Route::get('order/{id}', [UserController::class, 'orderDetails'])->name('user.order-details');
});

//Cart
Route::get('cart', [CartController::class, 'cartList'])->name('cart.list');
Route::post('cart', [CartController::class, 'addToCart'])->name('cart.store');
Route::post('update-cart', [CartController::class, 'updateCart'])->name('cart.update');
Route::post('remove', [CartController::class, 'removeCart'])->name('cart.remove');
Route::post('clear', [CartController::class, 'clearAllCart'])->name('cart.clear');

//Checkout
Route::get('checkout', [CheckoutController::class, 'index'])->name('checkout.index');
Route::post('checkout', [CheckoutController::class, 'store'])->name('checkout.store');
Route::get('order/confirmation/{id}', [CheckoutController::class, 'confirmation'])->name('order.confirmation');

// Dashboard redirect based on role
Route::get('/dashboard', function () {
    if (auth()->check()) {
        return auth()->user()->isAdmin() 
            ? redirect()->route('admin.dashboard') 
            : redirect()->route('user.dashboard');
    }
    return redirect()->route('admin.login');
})->name('dashboard');

Route::middleware(['auth', 'isadmin'])->group(function () {
    //Admin Routing
    Route::get('/admin-dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/manage-categories', [CategoryController::class, 'manageCategory'])->name('manage.categories');
    Route::post('/add-category', [CategoryController::class, 'addCategory'])->name('add.category');
    Route::get('/delete-category/{id}', [CategoryController::class, 'deleteCategory'])->name('delete.category');
    Route::get('/manage-categories/edit/{id}', [CategoryController::class, 'editCategory'])->name('edit.category');
    Route::post('/update-category', [CategoryController::class, 'updateCategory'])->name('update.category');

    Route::get('/add-product', [ProductController::class, 'addProduct'])->name('add.product');
    Route::post('/save-product', [ProductController::class, 'saveProduct'])->name('save.product');
    Route::get('/manage-products', [ProductController::class, 'manageProduct'])->name('manage.products');
    Route::get('/edit-product/{id}', [ProductController::class, 'editProduct'])->name('edit.product');
    Route::post('/update-product', [ProductController::class, 'updateProduct'])->name('update.product');
    Route::get('/delete-product/{id}', [ProductController::class, 'deleteProduct'])->name('delete.product');

    Route::get('/manage-orders', [OrderController::class, 'manageOrder'])->name('manage.orders');
    Route::get('/view-order/{id}', [OrderController::class, 'viewOrder'])->name('view.order');
    Route::post('/update-order-status/{id}', [OrderController::class, 'updateStatus'])->name('update.order.status');
    Route::post('/add-order-notes/{id}', [OrderController::class, 'addNotes'])->name('add.order.notes');

    Route::get('/sales', [SalesController::class, 'index'])->name('sales');
    Route::get('/sales/export-excel', [SalesController::class, 'exportAnalyticsExcel'])->name('sales.export.excel');
    Route::get('/sales/export-pdf', [SalesController::class, 'exportAnalyticsPDF'])->name('sales.export.pdf');
    Route::get('/sales/export-orders-excel', [SalesController::class, 'exportOrdersExcel'])->name('sales.export.orders');

    Route::get('/manage-users', [UserController::class, 'manageUsers'])->name('manage.users');
    Route::get('/view-user/{id}', [UserController::class, 'viewUser'])->name('view.user');
    Route::get('/delete-user/{id}', [UserController::class, 'deleteUser'])->name('delete.user');

    Route::get('/settings', [SettingsController::class, 'index'])->name('settings');
    Route::put('/settings', [SettingsController::class, 'update'])->name('settings.update');

    Route::post('/admin-logout', [AdminAuthenticatedSessionController::class, 'destroy'])->name('admin.logout');
});
