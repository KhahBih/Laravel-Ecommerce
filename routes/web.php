<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Frontend\FlashSaleController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\UserProfileController;
use App\Http\Controllers\Frontend\FrontendProductController;
use App\Http\Controllers\Frontend\AddressController;
use App\Http\Controllers\Frontend\CartController;
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

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::get('admin/login', [AdminController::class, 'login'])->name('admin.login');
Route::get('flash-sale', [FlashSaleController::class, 'index'])->name('flash-sale');
Route::get('product-detail/{slug}', [FrontendProductController::class, 'showProduct'])->name('product-detail');

// Cart routes
Route::post('/add-to-card', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::get('/cart-details', [CartController::class, 'cartDetails'])->name('cart-details');
Route::post('/update-quantity', [CartController::class, 'updateQuantity'])->name('update-quantity');
Route::get('clear-cart', [CartController::class, 'clearCart'])->name('clear-cart');
Route::get('cart/remove-product/{rowId}', [CartController::class, 'removeProduct'])->name('cart.remove-product');
Route::get('cart-count', [CartController::class, 'getCartCount'])->name('cart-count');

Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function(){
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [UserProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [UserProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile', [UserProfileController::class, 'updatePassword'])->name('profile.update.password');
    Route::get('/address/getDistrict', [AddressController::class, 'getDistrict'])->name('address.getDistrict');
    Route::get('/address/getWard', [AddressController::class, 'getWard'])->name('address.getWard');
    Route::resource('/address', AddressController::class);
});



