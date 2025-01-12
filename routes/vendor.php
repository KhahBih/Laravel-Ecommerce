<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\VendorOrderController;
use App\Http\Controllers\Backend\VendorShopProfileController;
use App\Http\Controllers\Backend\VendorProfileController;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\VendorProductImageGalleryController;
use App\Http\Controllers\Backend\VendorProductVariantController;
use App\Http\Controllers\Backend\VendorProductVariantItemController;

Route::get('products/get-sub-categories', [VendorProductController::class, 'getSubCategories'])->name('products.get-sub-categories');
Route::get('products/get-child-categories', [VendorProductController::class, 'getChildCategories'])->name('products.get-child-categories');
Route::get('/dashboard', [VendorController::class, 'dashboard'])->name('dashboard');
Route::get('/profile', [VendorProfileController::class, 'index'])->name('profile');
Route::put('/profile', [VendorProfileController::class, 'updateProfile'])->name('profile.update');
Route::post('/profile', [VendorProfileController::class, 'updatePassword'])->name('profile.update.password');

Route::resource('/shop-profile', VendorShopProfileController::class)->names([
    'index' => 'shop-profile.index',
]);
Route::resource('/products', VendorProductController::class);
Route::resource('/vendor-product-image-gallery', VendorProductImageGalleryController::class);

// Variant order routes
Route::get('/orders', [VendorOrderController::class, 'index'])->name('orders');
Route::get('/order/show/{id}', [VendorOrderController::class, 'show'])->name('order.show');
Route::get('/order/status/{id}', [VendorOrderController::class, 'changeOrderStatus'])->name('order.status');

// Product Variant routes
Route::resource('products-variant', VendorProductVariantController::class);
Route::get('products-variant-item/{productId}/{variantId}', [VendorProductVariantItemController::class, 'index'])->name('products-variant-item.index');
Route::get('products-variant-item/create/{productId}/{variantId}', [VendorProductVariantItemController::class, 'create'])->name('products-variant-item.create');
Route::post('products-variant-item/{variantId}', [VendorProductVariantItemController::class, 'store'])->name('products-variant-item.store');
Route::get('products-variant-item-edit/{productVariantItemId}', [VendorProductVariantItemController::class, 'edit'])->name('products-variant-item.edit');
Route::put('products-variant-item-update/{productVariantItemId}', [VendorProductVariantItemController::class, 'update'])->name('products-variant-item.update');
Route::delete('products-variant-item-delete/{productVariantItemId}', [VendorProductVariantItemController::class, 'destroy'])->name('products-variant-item.destroy');
?>
