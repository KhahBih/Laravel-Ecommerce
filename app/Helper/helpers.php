<?php
    // Set sidebar items active

use App\Models\GeneralSetting;

    function setActive(array $route){
        if(is_array($route)){
            foreach($route as $r){
                if(request()->routeIs($r)){
                    return 'active';
                }
            }
        }
    }

    function checkDiscount($product) {
        $currentDate = date('Y-m-d');
        if($product->offer_price > 0 && $currentDate >= $product->offer_start_date && $currentDate <= $product->offer_end_date) {
            return true;
        }
        return false;
    }

    function getCartTotal() {
        $total = 0;
        foreach(Cart::content() as $product){
            $total += ($product->price + $product->options->variants_total) * $product->qty;
        }
        return $total;
    }

    function getMainCartTotal() {
        if(Session::has('coupon')){
            $coupon = Session::get('coupon');
            if($coupon['discount_type'] == 'amount'){
                $total = getCartTotal() - $coupon['discount_value'];
                return $total;
            }elseif($coupon['discount_type'] == 'percent'){
                $total = getCartTotal() - ((getCartTotal() * $coupon['discount_value']) / 100);
                return $total;
            }
        }else{
            return getCartTotal();
        }
    }

    function getMainCartDiscount() {
        if(Session::has('coupon')){
            $coupon = Session::get('coupon');
            if($coupon['discount_type'] == 'amount'){
                return $coupon['discount_value'] . GeneralSetting::first()->currency_icon;
            }elseif($coupon['discount_type'] == 'percent'){
                $discount = $coupon['discount_value'];
                return $discount . '%';
            }
        }else{
            return 0 . GeneralSetting::first()->currency_icon;
        }
    }

    // Calculate discount percentage
    function calculateDiscountPercent($price, $offerPrice) {
        $discountAmount = $price - $offerPrice;
        $percent = ($discountAmount / $price) * 100;
        return $percent;
    }
    // Check product type
    function checkProductType($type):string {
        switch($type){
            case 'new_arrival':
                return 'New';
                break;
            case 'featured_product':
                return 'Featured';
                break;
            case 'top_product':
                return 'Top';
                break;
            case 'best_product':
                return 'Best';
                break;
            default:
                return '';
                break;
        }
    }

    function getShippingFee(){
        if(Session::has('shipping_method')){
            return Session::get('shipping_method')['cost'];
        }else{
            return 0;
        }
    }

    function getFinalPayableAmount(){
        return getMainCartTotal() + getShippingFee();
    }
?>
