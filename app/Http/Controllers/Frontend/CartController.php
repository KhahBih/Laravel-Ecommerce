<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;

class CartController extends Controller
{
    public function addToCart(Request $request){
        $product = Product::findOrFail($request->product_id);
        $variants = [];
        foreach($request->variant_items as $item_id){
            $variantItem = ProductVariantItem::findOrFail($item_id);
            $variants[$variantItem->productVariant->name]['name'] = $variantItem->name;
        }
        dd($variants);
    }
}
