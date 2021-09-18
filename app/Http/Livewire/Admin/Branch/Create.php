<?php

namespace App\Http\Livewire\Admin\Branch;

use App\Models\Branch;
use Livewire\Component;

class Create extends Component
{
    public $branch_name;
    public $branch_email;
    public $branch_phone;
    public $branch_address;
    public $branch_city;
    public $branch_state;
    public $branch_pin;
    public $branch_country;


    public function render()
    {
        return view('livewire.admin.branch.create');
    }

//    public function store()
//    {
////        $this->validate([
////            'branch_name'=> 'required',
////            'branch_email'=> 'required',
////            'branch_phone'=> 'required|email',
////            'branch_address'=> 'required',
////            'branch_city'=> 'required',
////            'branch_state'=> 'required',
////            'branch_pin'=> 'required',
////            'branch_country'=> 'required',
////        ]);
//
//        $branch = new Branch;
//
//        $branch->branch_name =$this->branch_name;
//        $branch-> branch_email =$this->branch_email;
//        $branch->branch_phone =$this->branch_phone;
//        $branch->branch_address =$this->branch_address;
//        $branch-> branch_city =$this->branch_city;
//        $branch->branch_state =$this->branch_state;
//        $branch->branch_pin =$this->branch_pin;
//        $branch->branch_country= $this->branch_country;
//
//        $branch->save();
//
//        session()->flash('branch added successfully');
//    }
}
