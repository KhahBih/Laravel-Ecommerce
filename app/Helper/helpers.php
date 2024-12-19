<?php
    // Set sidebar items active
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
            $total =+ ($product->price + $product->options->variants_total) * $product->qty;
        }
        return $total;
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
?>
