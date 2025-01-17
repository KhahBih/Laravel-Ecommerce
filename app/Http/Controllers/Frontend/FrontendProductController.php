<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendProductController extends Controller
{
    public function showProduct(string $slug){
        $generalSetting = GeneralSetting::first();
        $product = Product::with(['vendor', 'category', 'imageGalleries', 'variants', 'brand'])
        ->where('slug', $slug)->where('status', 1)->first();
        return view('frontend.pages.product-detail', compact('product', 'generalSetting'));
    }
}
