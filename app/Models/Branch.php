<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;
    protected $fillable = [
        'branch_name' ,
        'branch_email',
        'branch_phone' ,
        'branch_address' ,
        'branch_city',
        'branch_state' ,
        'branch_pin',
        'branch_country',
    ];

    public function users() {
        return $this->hasMany(User::class);
    }

    public function courier_infos() {
        return $this->hasMany(CourierInfo::class);
    }
}
