<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard(){
        return view('aadmin.dashboard');
    }

    public function login(){
        return view('admin.auth.login');
    }
}
