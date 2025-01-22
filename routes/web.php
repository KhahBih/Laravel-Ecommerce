<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Frontend\PaymentController;
use App\Http\Controllers\Gateways\PaypalController;
use App\Http\Controllers\Frontend\CheckOutController;
use App\Http\Controllers\Frontend\FlashSaleController;
use App\Http\Controllers\Frontend\HomeController;
use App\Http\Controllers\Frontend\UserDashboardController;
use App\Http\Controllers\Frontend\UserOrderController;
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
Route::get('products', [FrontendProductController::class, 'products'])->name('products');

// Cart routes
Route::post('/add-to-card', [CartController::class, 'addToCart'])->name('add-to-cart');
Route::get('/cart-details', [CartController::class, 'cartDetails'])->name('cart-details');
Route::post('/update-quantity', [CartController::class, 'updateQuantity'])->name('update-quantity');
Route::get('clear-cart', [CartController::class, 'clearCart'])->name('clear-cart');
Route::get('cart/remove-product/{rowId}', [CartController::class, 'removeProduct'])->name('cart.remove-product');
Route::get('cart-count', [CartController::class, 'getCartCount'])->name('cart-count');
Route::get('cart-products', [CartController::class, 'getCartProducts'])->name('cart-products');
Route::post('cart/remove-sidebar-product', [CartController::class, 'removeSidebarProduct'])->name('cart.remove-sidebar-product');
Route::get('cart/sidebar-product-total', [CartController::class, 'getCartTotal'])->name('cart.total');
Route::get('cart/apply-coupon', [CartController::class, 'applyCoupon'])->name('cart.apply-coupon');
Route::get('cart/coupon-calculate', [CartController::class, 'couponCalculate'])->name('cart.coupon-calculate');

Route::group(['middleware' => ['auth', 'verified'], 'prefix' => 'user', 'as' => 'user.'], function(){
    Route::get('/dashboard', [UserDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [UserProfileController::class, 'index'])->name('profile');
    Route::put('/profile', [UserProfileController::class, 'updateProfile'])->name('profile.update');
    Route::post('/profile', [UserProfileController::class, 'updatePassword'])->name('profile.update.password');
    Route::get('/address/getDistrict', [AddressController::class, 'getDistrict'])->name('address.getDistrict');
    Route::get('/address/getWard', [AddressController::class, 'getWard'])->name('address.getWard');
    Route::resource('/address', AddressController::class);

    // Check Out Routes
    Route::get('/check-out', [CheckOutController::class, 'index'])->name('checkout');
    Route::post('/check-out/create-address', [CheckOutController::class, 'store'])->name('checkout.create-address');
    Route::post('/check-out/form-submit', [CheckOutController::class, 'formSubmit'])->name('checkout.form-submit');

    // Payment routes
    Route::get('payment', [PaymentController::class, 'index'])->name('payment');
    Route::get('payment-success', [PaymentController::class, 'paymentSuccess'])->name('payment.success');

    // Paypal routes
    Route::get('paypal/payment', [PaymentController::class, 'payWithPaypal'])->name('paypal.payment');
    Route::get('paypal/success', [PaymentController::class, 'paypalSuccess'])->name('paypal.success');
    Route::get('paypal/cancel', [PaymentController::class, 'paypalCancel'])->name('paypal.cancel');

    // Stripe routes
    Route::post('stripe/payment', [PaymentController::class, 'payWithStripe'])->name('stripe.payment');

    // Order routes
    Route::get('/orders', [UserOrderController::class, 'index'])->name('orders');
    Route::get('/order/show/{id}', [UserOrderController::class, 'show'])->name('order.show');
});



