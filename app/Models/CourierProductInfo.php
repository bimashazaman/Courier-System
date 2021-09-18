<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CouriarType;

class CourierProductInfo extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function courier_info() {
        return $this->belongsTo(CourierInfo::class);
    }

    public function courier_type() {
        return $this->belongsTo(CouriarType::class, 'courier_type');
    }
}
