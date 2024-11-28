<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index(){
        $generalSettings = GeneralSetting::first();
        return view('admin.setting.index', compact('generalSettings'));
    }

    public function generalSettingsUpdate(Request $request){
        $request->validate([
            'site_name' => ['required', 'max:200'],
            'layout' => ['required', 'max:200'],
            'email' => ['required', 'max:200', 'email'],
            'default_currency' => ['required', 'max:200'],
            'currency_icon' => ['required', 'max:200'],
            'time_zone' => ['required', 'max:200'],
        ]);

        GeneralSetting::updateOrCreate(
            ['id' => 1],
            [
                'site_name' => $request->site_name,
                'layout' => $request->layout,
                'contact_email' => $request->email,
                'default_currency_name' => $request->default_currency,
                'currency_icon' => $request->currency_icon,
                'time_zone' => $request->time_zone
            ]
        );
        toastr('Updated Successfully!', 'success', 'success');
        return redirect()->back();
    }
}
