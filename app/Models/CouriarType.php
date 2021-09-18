<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CouriarType extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function unit() {
        return $this->belongsTo(Unit::class);
    }

    public function courier_product_infos() {
        return $this->hasMany(CourierProductInfo::class);
    }



}
