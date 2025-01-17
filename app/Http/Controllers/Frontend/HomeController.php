<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Slider;
use App\Models\FlashSale;
use App\Models\FlashSaleItem;
use App\Models\GeneralSetting;
use App\Models\HomePageSetting;

class HomeController extends Controller
{
    public function index(){
        $sliders = Slider::where('status', 1)->orderBy('serial', 'asc')->get();
        $flashSaleDate = FlashSale::first();
        $flashSaleItems = FlashSaleItem::where('show_at_home', 1)->where('status', 1)->get();
        $generalSetting = GeneralSetting::first();
        $popularCategory = HomePageSetting::where('key', 'popular_category_section')->first();
        return view('frontend.home.home', compact('sliders', 'flashSaleDate', 'flashSaleItems', 'generalSetting', 'popularCategory'));
    }
}
