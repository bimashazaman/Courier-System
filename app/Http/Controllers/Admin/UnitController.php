<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Unit;

use Illuminate\Http\Request;

class UnitController extends Controller
{
    public function index() {
        $unitList = Unit::all();
        return view('Admin.Unit.list', compact('unitList'));
    }

    public function create()
    {
        return view('Admin.Unit.add');
    }

    public function store(Request $request) {
        //form validation
        $request->validate([
            'name' => 'required|max:50|unique:units',
        ]);

        $data = $request->all();

        if ($request->get('status')) {
            $data['status'] = "Active";
        } else {
            $data += ["status" => "Inactive"];
        }

        Unit::create($data);

        return back()->withSuccess('Unit created successfully');
    }


    public function edit(Unit $unit ) {
        return view('Admin.Unit.edit', compact('unit'));
    }

    public function update(Request $request, Unit $unit) {

        if ($request->get('status')) {
            $status = "Active";
        } else {
            $status = "Inactive";
        }
        $unit->status = $status;
        $unit->save();
        return back()->withSuccess('Unit updated successfully');
    }


}
