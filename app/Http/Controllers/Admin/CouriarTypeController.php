<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\CouriarType;
use App\Models\Unit;

use Illuminate\Http\Request;

class CouriarTypeController extends Controller
{
    public function index() {
        $courierTypeList = CouriarType::all();
        return view('Admin.Type.index', compact('courierTypeList'));
    }

    public function create() {
        $unitList = Unit::all()->where('status', 'Active');
        return view('Admin.Type.add', compact('unitList'));
    }

    public function store(Request $request) {

        $request->validate([
            'name' => 'required|max:50',
            'unit_id' => 'required',
            'price' => 'required|numeric'
        ]);

        $data = $request->all();

        if ($request->get('status')) {
            $data['status'] = "Active";
        } else {
            $data += ["status" => "Inactive"];
        }

        CouriarType::create($data);

        return back()->withSuccess("Type created successfully");
    }

    public function edit(CouriarType $type) {

        $unitList = Unit::all();
        return view('Admin.Type.edit', compact('type', 'unitList'));
    }

    public function update(Request $request, CouriarType $type) {

        if ($request->get('status')) {
            $status = "Active";
        } else {
            $status = "Inactive";
        }

        $type->price = $request->price;
        $type->status = $status;
        $type->save();

        return back()->withSuccess('Type updated successfully');
    }



}
