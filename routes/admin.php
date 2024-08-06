<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\ProfileController;
use App\Http\Controllers\Backend\VendorController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ChildCategoryController;
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
?>
