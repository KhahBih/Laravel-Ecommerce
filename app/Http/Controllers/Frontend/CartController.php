<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\GeneralSetting;
use App\Models\Product;
use App\Models\ProductVariantItem;
use Illuminate\Http\Request;
use Cart;
use Illuminate\Support\Facades\Session;

class CartController extends Controller
{
    public function addToCart(Request $request){
        $product = Product::findOrFail($request->product_id);
        if($product->quantity == 0){
            return response(['status' => 'error', 'message' => 'Product Stock Out!']);
        }elseif($product->quantity < $request->qty){
            return response(['status' => 'error', 'message' => 'Quantity Not Available In Our Stock']);
        }
        $variants = [];
        $variantTotalAmount = 0;
        if($request->has('variant_items')){
            foreach($request->variant_items as $item_id){
                $variantItem = ProductVariantItem::findOrFail($item_id);
                $variants[$variantItem->productVariant->name]['name'] = $variantItem->name;
                $variants[$variantItem->productVariant->name]['price'] = $variantItem->price;
                $variantTotalAmount += $variantItem->price;
            }
        }

        $productPrice = 0;
        if(checkDiscount($product)){
            $productPrice += $product->offer_price;
        }else{
            $productPrice += $product->price;
        };

        $cartData = [];
        $cartData['id'] = $product->id;
        $cartData['name'] = $product->name;
        $cartData['qty'] = $request->qty;
        $cartData['price'] = $productPrice;
        $cartData['weight'] = 10;
        $cartData['options']['variants'] = $variants;
        $cartData['options']['variants_total'] = $variantTotalAmount;
        $cartData['options']['image'] = $product->thumb_image;
        $cartData['options']['slug'] = $product->slug;
        Cart::add($cartData);
        return response(['status' => 'success', 'message' => 'Added to cart successfully!']);
    }

    public function applyCoupon(Request $request){
        $coupon = Coupon::where(['code' => $request->coupon_code, 'status' => 1])->first();
        if($coupon === null){
            return response(['status' => 'error', 'message' => 'Coupon not exist!']);
        }elseif($coupon->start_date > date('Y-m-d')){
            return response(['status' => 'error', 'message' => 'Coupon not exist!']);
        }elseif($coupon->end_date < date('Y-m-d')){
            return response(['status' => 'error', 'message' => 'Coupon has expired!']);
        }elseif($coupon->total_used >= $coupon->quantity){
            return response(['status' => 'error', 'message' => 'You cannot use this coupon!']);
        }

        if($coupon->discount_type == 'Amount'){
            Session::put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_code' => $coupon->code,
                'discount_type' => 'amount',
                'discount_value' => $coupon->discount_value,
            ]);
        }elseif($coupon->discount_type == 'Percentage'){
            Session::put('coupon', [
                'coupon_name' => $coupon->name,
                'coupon_code' => $coupon->code,
                'discount_type' => 'percent',
                'discount_value' => $coupon->discount_value,
            ]);
        }
        return response(['status' => 'success', 'message' => 'Coupon applied successfully!']);
    }

    public function cartDetails(){
        $cartItems = Cart::content();
        return view('frontend.pages.cart-detail', compact('cartItems'));
    }

    public function updateQuantity(Request $request){
        Cart::update($request->rowId, $request->quantity);
        $cartItem = Cart::get($request->rowId);
        $product = Product::findOrFail($cartItem->id);
        $currencyIcon = GeneralSetting::first();
        if($product->quantity < $request->quantity){
            Cart::update($request->rowId, $request->quantity - 1);
            $productTotal = $this->getProductTotal($request->rowId);
            return response(['status' => 'error', 'message' => 'Product Out Of Stock!', 'product_total' => $productTotal,
             'currencyIcon' => $currencyIcon->currency_icon]);
        }else{
            $productTotal = $this->getProductTotal($request->rowId);
            return response(['status' => 'success', 'message' => 'Updated Successfully!',
            'product_total' => $productTotal, 'currencyIcon' => $currencyIcon->currency_icon, 'cartItem' => $cartItem,
            'productStock' => $product->quantity]);
        }
    }

    public function getProductTotal($rowId){
        $product = Cart::get($rowId);
        $total = ($product->price + $product->options->variants_total) * $product->qty;
        return $total;
    }

    public function clearCart(){
        Cart::destroy();
        return response(['status' => 'success', 'message' => 'Cart Cleared Successfully!']);
    }

    public function removeProduct($rowId){
        Cart::remove($rowId);
        return redirect()->route('cart-details');
    }

    public function removeSidebarProduct(Request $request){
        Cart::remove($request->rowId);
        return response(['status' => 'success', 'message' => 'Removed Product Successfully!', 'rowId' => $request->rowId]);
    }

    public function getCartCount(){
        return Cart::content()->count();
    }

    public function getCartProducts(){
        return Cart::content();
    }

    public function getCartTotal(){
        $total = 0;
        foreach(Cart::content() as $product){
            $total += $this->getProductTotal($product->rowId);
        }
        return $total;
    }
}
