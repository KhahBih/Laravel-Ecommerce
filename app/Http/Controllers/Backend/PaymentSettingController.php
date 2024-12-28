<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class PaymentSettingController extends Controller
{
    public function index(){
        $generalSettings = GeneralSetting::first();
        return view('admin.payment-settings.index', compact('generalSettings'));
    }
}
