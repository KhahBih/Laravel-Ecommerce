<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use App\Models\PaypalSetting;
use App\Models\StripeSetting;
use Illuminate\Http\Request;

class PaymentSettingController extends Controller
{
    public function index(){
        $generalSettings = GeneralSetting::first();
        $paypalSetting = PaypalSetting::first();
        $stripeSetting = StripeSetting::first();
        return view('admin.payment-settings.index', compact('generalSettings', 'paypalSetting', 'stripeSetting'));
    }
}
