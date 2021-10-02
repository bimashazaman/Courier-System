<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CourierInfo extends Model
{
    use HasFactory;
    protected $guarded = [];



    public function courier_product_infos() {
        return $this->hasMany(CourierProductInfo::class, 'courier_info_id');
    }

    public function branch() {
        return $this->belongsTo(Branch::class, 'sender_branch_id');
    }

    public function payment_receiver() {
        return $this->belongsTo(User::class, 'payment_receiver_id');
    }

    public function receiver_branch() {
        return $this->belongsTo(Branch::class, 'receiver_branch_id');
    }

}
