<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\ProductVariantController;
use App\Http\Controllers\Backend\ProductVariantItemController;
use App\Http\Controllers\Backend\ProductImageGalleryController;
use App\Http\Controllers\Backend\AdminVendorProfileController;
use App\Http\Controllers\Backend\SellerProductController;
use App\Http\Controllers\Backend\FlashSaleController;
use App\Http\Controllers\Backend\SettingController;
use App\Http\Controllers\Backend\CouponController;
use App\Http\Controllers\Backend\PaypalSettingController;
use App\Http\Controllers\Backend\PaymentSettingController;
use App\Http\Controllers\Backend\ShippingRuleController;
use App\Http\Controllers\Backend\StripeSettingController;
use Illuminate\Http\Request;

Route::get('dashboard', [AdminController::class, 'dashboard'])->middleware(['auth', 'role:admin'])->name('dashboard');
Route::get('profile', [ProfileController::class, 'index'])->name('profile');
Route::post('profile/update', [ProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('profile/update/password', [ProfileController::class, 'updatePassword'])->name('password.update');
Route::get('get-subcategory', [ChildCategoryController::class, 'getSubCategories'])->name('get-subCategories');


// Slider routes
Route::resource('slider', SliderController::class);

// Category routes
Route::resource('category', CategoryController::class);
Route::resource('sub-category', SubCategoryController::class);
Route::resource('child-category', ChildCategoryController::class);

// Brand routes
Route::resource('brand', BrandController::class);
Route::resource('vendor-profile', AdminVendorProfileController::class);

// Product routes
Route::get('products/get-sub-categories', [ProductController::class, 'getSubCategories'])->name('product.get-sub-categories');
Route::get('products/get-child-categories', [ProductController::class, 'getChildCategories'])->name('product.get-child-categories');
Route::resource('products', ProductController::class);
Route::resource('products-image-gallery', ProductImageGalleryController::class);
Route::resource('products-variant', ProductVariantController::class);
Route::get('products-variant-item/{productId}/{variantId}', [ProductVariantItemController::class, 'index'])->name('products-variant-item.index');
Route::get('products-variant-item/create/{productId}/{variantId}', [ProductVariantItemController::class, 'create'])->name('products-variant-item.create');
Route::post('products-variant-item/{variantId}', [ProductVariantItemController::class, 'store'])->name('products-variant-item.store');
Route::get('products-variant-item-edit/{productVariantItemId}', [ProductVariantItemController::class, 'edit'])->name('products-variant-item.edit');
Route::put('products-variant-item-update/{productVariantItemId}', [ProductVariantItemController::class, 'update'])->name('products-variant-item.update');
Route::delete('products-variant-item-delete/{productVariantItemId}', [ProductVariantItemController::class, 'destroy'])->name('products-variant-item.destroy');

// Seller product
Route::get('seller-products', [SellerProductController::class, 'index'])->name('seller-products.index');
Route::get('seller-pending-products', [SellerProductController::class, 'pending'])->name('seller-pending-products.index');
Route::put('change-approve-status', [SellerProductController::class, 'changeApproveStatus'])->name('change-approve-status');

// Flash Sale
Route::get('flash-sale', [FlashSaleController::class, 'index'])->name('flash-sale.index');
Route::get('flash-sale-item/edit/{id}', [FlashSaleController::class, 'edit'])->name('flash-sale-item.edit');
Route::put('flash-sale-update', [FlashSaleController::class, 'update'])->name('flash-sale.update');
Route::put('flash-sale-item-update/{flashSaleItemId}', [FlashSaleController::class, 'updateFlashSaleItem'])->name('flash-sale-item.update');
Route::post('flash-sale/add-product', [FlashSaleController::class, 'addProduct'])->name('flash-sale.addProduct');
Route::delete('flash-sale/{id}', [FlashSaleController::class, 'destroy'])->name('flash-sale.destroy');

// Coupon routes
Route::resource('coupons', CouponController::class);

// Shipping rule route
Route::resource('shipping-rule', ShippingRuleController::class);

// Setting routes
Route::get('settings', [SettingController::class, 'index'])->name('settings.index');
Route::put('general-settings-update', [SettingController::class, 'generalSettingsUpdate'])->name('settings.update');

// Payment Setting routes
Route::get('payment-settings', [PaymentSettingController::class, 'index'])->name('payment-settings.index');
Route::resource('paypal-setting', PaypalSettingController::class);
Route::put('stripe-setting/{id}', [StripeSettingController::class, 'update'])->name('stripe-setting.update');


