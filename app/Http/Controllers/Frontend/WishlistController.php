<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    public function index(){
        return view('frontend.pages.wishlist');
    }

    public function addProductWishlist(Request $request){
        $wishlistCount = Wishlist::where(['product_id' => $request->id, 'user_id' => Auth::user()->id])->count();
        if(!Auth::check()){
            return response(['status' => 'error', 'message' => 'Please login to add product to wishlist!']);
        }else if($wishlistCount > 0){
            return response(['status' => 'error', 'message' => 'The product is already at wishlist!']);
        }else{
            $wishlist = new Wishlist();
            $wishlist = $request->id;
            $wishlist = Auth::user()->id;
            $wishlist->save();

            return response(['status' => 'success', 'message' => 'Added to wishlist!']);
        }
    }
}
