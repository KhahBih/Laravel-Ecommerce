<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\GeneralSetting;
use App\Models\HomePageSetting;
use App\Models\Product;

class HomeController extends Controller
{
    public function index(){
        $sliders = Slider::where('status', 1)->orderBy('serial', 'asc')->get();
        $flashSaleDate = FlashSale::first();
        $flashSaleItems = FlashSaleItem::where('show_at_home', 1)->where('status', 1)->get();
        $generalSetting = GeneralSetting::first();
        $popularCategory = HomePageSetting::where('key', 'popular_category_section')->first();
        $brands = Brand::where('status', 1)->where('is_featured', 1)->get();
        $typeBaseProduct = $this->getTypeBaseProduct();
        $categoryProductSliderSectionOne = HomePageSetting::where('key', 'product_slider_section_one')->first();
        $categoryProductSliderSectionTwo = HomePageSetting::where('key', 'product_slider_section_two')->first();
        $categoryProductSliderSectionThree = HomePageSetting::where('key', 'product_slider_section_three')->first();
        return view('frontend.home.home', compact('sliders','brands', 'flashSaleDate',
        'flashSaleItems', 'generalSetting', 'popularCategory', 'typeBaseProduct', 'categoryProductSliderSectionOne'
    , 'categoryProductSliderSectionTwo', 'categoryProductSliderSectionThree'));
    }

    public function getTypeBaseProduct(){
        $typeBaseProduct = [];
        $typeBaseProduct['new_arrival'] = Product::where(['product_type' => 'new_arrival', 'status' => 1, 'is_approved' => 1])
        ->orderBy('id', 'DESC')->take(8)->get();
        $typeBaseProduct['featured_product'] = Product::where(['product_type' => 'featured_product', 'status' => 1, 'is_approved' => 1])
        ->orderBy('id', 'DESC')->take(8)->get();
        $typeBaseProduct['top_product'] = Product::where(['product_type' => 'top_product', 'status' => 1, 'is_approved' => 1])
        ->orderBy('id', 'DESC')->take(8)->get();
        $typeBaseProduct['best_product'] = Product::where(['product_type' => 'best_product', 'status' => 1, 'is_approved' => 1])
        ->orderBy('id', 'DESC')->take(8)->get();

        return $typeBaseProduct;
    }
}
