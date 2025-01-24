<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use App\Models\GeneralSetting;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class FrontendProductController extends Controller
{
    public function showProduct(string $slug){
        $generalSetting = GeneralSetting::first();
        $product = Product::with(['vendor', 'category', 'imageGalleries', 'variants', 'brand'])
        ->where('slug', $slug)->where('status', 1)->first();
        return view('frontend.pages.product-detail', compact('product', 'generalSetting'));
    }

    public function products(Request $request){
        if($request->has('category')){
            $category = Category::where('slug', $request->category)->first();
            $products = Product::where(['category_id' => $category->id, 'status' => 1, 'is_approved' => 1])->paginate(12);
        }elseif($request->has('sub_category')){
            $category = SubCategory::where('slug', $request->sub_category)->first();
            $products = Product::where(['sub_category_id' => $category->id, 'status' => 1, 'is_approved' => 1])->paginate(12);
        }elseif($request->has('child_category')){
            $category = ChildCategory::where('slug', $request->child_category)->first();
            $products = Product::where(['child_category_id' => $category->id, 'status' => 1, 'is_approved' => 1])->paginate(12);
        }
        return view('frontend.pages.product', compact('category', 'products'));
    }

    public function changeProductListView(Request $request){
        Session::put('product_list_style', $request->style);
    }
}
