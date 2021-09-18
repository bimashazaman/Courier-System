<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;


class PackageController extends Controller
{
 public function index()
 {
     $package = Package::all();
     return view('Admin.package.index' , compact('package'));
 }

 public function create()
 {
     return view('Admin.package.create');
 }

 public function store(Request $request)
 {
     $this->validate($request,[
         'name'=>'required',
         'base_price'=>'required',
         'tax'=>'required',
         'total_price'=>'required',

     ]);

     $package = Package::create($request->all());
     return redirect()->route('admin.package.index');
 }

 public function updateView($id)
 {
     $package = Package::find($id);
     return view('Admin.package.update' , compact('package'));

 }

 public function update(Request $request, $id)
 {

     $package = Package::find($id);

     $this->validate($request,[
         'name'=>'required',
         'base_price'=>'required',
         'tax'=>'required',
         'total_price'=>'required',

     ]);


      Package::whereId($id)->update($request->except('_method', '_token'));

     return redirect()->route('admin.package.index');

 }

 public function delete($id)
 {
     Package::find($id)->delete();
     return redirect()->route('admin.package.index');
 }




}
