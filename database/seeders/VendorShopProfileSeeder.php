<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Vendor;
use Illuminate\Database\Seeder;

class VendorShopProfileSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('email', 'vendor@gmail.com')->first();
        $vendor = new Vendor();
        $vendor->banner = 'uploads/1324.jpg';
        $vendor->phone = '0376402133';
        $vendor->email = 'vendor@gmail.com';
        $vendor->address = 'vn';
        $vendor->description = 'asfasf asasfaf';
        $vendor->user_id = $user->id;
        $vendor->save();
    }
}
