<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\VendorController;

Route::get('vendor/dashboard', [VendorController::class, 'dashboard'])->middleware(['auth', 'role:vendor'])->name('vendor.dashboard');
?>
