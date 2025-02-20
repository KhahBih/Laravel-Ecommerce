<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use File;

class UserProfileController extends Controller
{
    public function index(){
        return view('frontend.dashboard.profile');
    }
    public function updateProfile(Request $request){
        $request->validate([
            'image' => ['image', 'max:10240'],
            'name' => ['required', 'max:100'],
            'email' => ['required', 'email', 'unique:users,email,'.Auth::user()->id]
        ]);

        $user = Auth::user();
        if($request->hasFile('image')){
            if(File::exists(public_path($user->image))){
                File::delete(public_path($user->image));
            }
            $image = $request->image;
            $imageName = rand().'_'.$image->getClientOriginalName();
            $image->move(public_path('uploads'), $imageName);
            // Xử lý và đưa vào db
            $path = "/uploads/".$imageName;
            $user->image = $path;
        }

        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        toastr()->success('Cập nhật thành công!');
        return redirect()->back();
    }

    public function updatePassword(Request $request){
        $request->validate([
            'current_password' => ['required', 'current_password', 'string'],
            'password' => ['required', 'confirmed', 'min:8']
        ]);

        $request->user()->update([
            'password' => bcrypt($request->password)
        ]);

        toastr()->success('Đổi mật khẩu thành công!');
        return redirect()->back();
    }
}
