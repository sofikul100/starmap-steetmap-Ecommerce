<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Coupon extends Model
{
    use HasFactory,SoftDeletes;


    public function setCouponCodeAttribute($value){
        $this->attributes['coupon_code'] = strtoupper($value);
    }

    public function setStartDateAttribute($value){
        $this->attributes['start_date'] = \Carbon\Carbon::parse($value)->format('d-m-Y');
    }

    public function setEndDateAttribute ($value){
        $this->attributes['end_date'] = \Carbon\Carbon::parse($value)->format('d-m-Y');
    }
}
