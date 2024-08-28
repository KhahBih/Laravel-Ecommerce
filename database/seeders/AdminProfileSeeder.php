<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\AdminVendorProfile;
use Illuminate\Database\Seeder;

class AdminProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'www.kbinh@gmail.com')->first();
        $vendor = new AdminVendorProfile();
        $vendor->banner = 'uploads/1324.jpg';
        $vendor->phone = '0376402133';
        $vendor->email = 'www.kbinh@gmail.com';
        $vendor->address = 'vn';
        $vendor->description = 'asfasf asasfaf';
        $vendor->user_id = $user->id;
        $vendor->save();
    }
}
