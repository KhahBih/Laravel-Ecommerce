<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserAddress;
use App\Models\Province;
use App\Models\District;
use App\Models\ShippingRule;
use App\Models\Ward;
use Illuminate\Support\Facades\Auth;

class CheckOutController extends Controller
{
    public function index(){
        $addresses = UserAddress::where('user_id', Auth::user()->id)->get();
        $provinces = Province::all();
        $districts = District::all();
        $wards = Ward::all();
        $shippingMethods = ShippingRule::where('status', 1)->get();
        return view('frontend.pages.check-out', compact('addresses', 'provinces', 'districts', 'wards', 'shippingMethods'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'address_name' => ['required', 'max:200'],
            'email' => ['required', 'max:200'],
            'phone' => ['required', 'max:200'],
            'province' => ['required', 'max:200'],
            'district' => ['required', 'max:200'],
            'ward' => ['required', 'max:200'],
            'zip_code' => ['required', 'max:200'],
            'address' => ['required', 'max:200'],
        ]);

        $address = new UserAddress();
        $address->name = $request->address_name;
        $address->email = $request->email;
        $address->phone = $request->phone;
        $address->province = $request->province;
        $address->district = $request->district;
        $address->ward = $request->ward;
        $address->zip_code = $request->zip_code;
        $address->detail_address = $request->address;
        $address->user_id = Auth::user()->id;
        $address->save();

        toastr('Created Successfully!', 'success', 'success');
        return redirect()->back();
    }
}
