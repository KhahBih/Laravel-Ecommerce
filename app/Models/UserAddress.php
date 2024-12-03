<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserAddress extends Model
{
    use HasFactory;
    protected $table = "user_addresses";
    public function district(){
        return $this->belongsTo(District::class, 'district', 'code');
    }

    public function province(){
        return $this->belongsTo(Province::class);
    }

    public function ward(){
        return $this->belongsTo(Ward::class, 'ward', 'code');
    }
}
