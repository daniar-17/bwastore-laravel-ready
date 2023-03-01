<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\DashboardTransactionController;
use App\Http\Controllers\DashboardSettingController;
use App\Http\Controllers\Admin\DashboardController as DashboardAdminController;
use App\Http\Controllers\CheckoutController;

use function Clue\StreamFilter\fun;

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
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/categories/{id}', [CategoryController::class, 'detail'])->name('categories-detail');

Route::get('/details/{id}', [DetailController::class, 'index'])->name('detail');
Route::post('/details/add/{id}', [DetailController::class, 'add'])->name('detail-add');

Route::post('/checkout/callback', [CheckoutController::class, 'callback'])->name('midtrans-callback');

Route::get('/success', [CartController::class, 'success'])->name('success');
Route::get('/register/success', [RegisterController::class, 'success'])->name('register-success');

// Middleware Auth
Route::group(['middleware' => ['auth']], function(){
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::delete('/cart/{id}', [CartController::class, 'delete'])->name('cart-delete');

    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout');

    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/dashboard/products', [DashboardProductController::class, 'index'])->name('dashboard-products');
    Route::get('/dashboard/products/details/{id}', [DashboardProductController::class, 'details'])->name('dashboard-products-details');
    Route::post('/dashboard/products/update/{id}', [DashboardProductController::class, 'update'])->name('dashboard-products-update');

    Route::post('/dashboard/products/gallery/upload', [DashboardProductController::class, 'uploadGallery'])->name('dashboard-products-gallery-upload');
    Route::get('/dashboard/products/gallery/delete', [DashboardProductController::class, 'deleteGallery'])->name('dashboard-products-gallery-delete');

    Route::get('/dashboard/products/create', [DashboardProductController::class, 'create'])->name('dashboard-products-create');
    Route::post('/dashboard/products/store', [DashboardProductController::class, 'store'])->name('dashboard-products-store');

    Route::get('/dashboard/transactions', [DashboardTransactionController::class, 'index'])->name('dashboard-transactions');
    Route::get('/dashboard/transactions/details/{id}', [DashboardTransactionController::class, 'details'])->name('dashboard-transactions-details');
    Route::post('/dashboard/transactions/update/{id}', [DashboardTransactionController::class, 'update'])->name('dashboard-transactions-update');

    Route::get('/dashboard/settings', [DashboardSettingController::class, 'store'])->name('dashboard-settings');
    Route::get('/dashboard/accounts', [DashboardSettingController::class, 'account'])->name('dashboard-accounts');
    Route::post('/dashboard/accounts/{redirect}', [DashboardSettingController::class, 'update'])->name('dashboard-redirect');

});

// Middleware Auth Admin
Route::prefix('admin')->namespace('Admin')->middleware(['auth','admin'])->group(function(){
    Route::get('/', [DashboardAdminController::class, 'index'])->name('admin-dashboard');
    Route::resource('category', '\App\Http\Controllers\Admin\CategoryController');
    Route::resource('user', '\App\Http\Controllers\Admin\UserController');
    Route::resource('product', '\App\Http\Controllers\Admin\ProductController');
    Route::resource('product-gallery', '\App\Http\Controllers\Admin\ProductGalleryController');
    Route::resource('transaction', '\App\Http\Controllers\Admin\TransactionController');
});

Auth::routes();

