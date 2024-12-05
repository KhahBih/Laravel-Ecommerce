<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\District;
use App\Models\Province;
use App\Models\UserAddress;
use App\Models\Ward;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AddressController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $addresses = UserAddress::where('user_id', Auth::user()->id)->get();
        $provinces = Province::all();
        $districts = District::all();
        $wards = Ward::all();
        return view('frontend.dashboard.address.index', compact('addresses', 'provinces', 'districts', 'wards'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $cities = Province::all();
        return view('frontend.dashboard.address.create', compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     */
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
        return redirect()->route('user.address.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $cities = Province::all();
        $address = UserAddress::findOrFail($id);
        $districts = District::all();
        $wards = Ward::all();
        return view('frontend.dashboard.address.edit', compact('address', 'cities', 'districts', 'wards'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
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

        $address = UserAddress::findOrFail($id);
        $address->name = $request->address_name;
        $address->email = $request->email;
        $address->phone = $request->phone;
        $address->province = $request->province;
        $address->district = $request->district;
        $address->ward = $request->ward;
        $address->zip_code = $request->zip_code;
        $address->detail_address = $request->address;
        $address->save();

        toastr('Updated Successfully!', 'success', 'success');
        return redirect()->route('user.address.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $address = UserAddress::findOrFail($id);
        $address->delete();
        toastr('Deleted Successfully!', 'success', 'success');
        return response(['status' => 'success', 'message' => 'Deleted Successfully!']);
    }

    public function getDistrict(Request $request)
    {
        $districts = District::where('province_code', $request->id)->get();
        return $districts;
    }

    public function getWard(Request $request)
    {
        $districts = Ward::where('district_code', $request->id)->get();
        return $districts;
    }
}
