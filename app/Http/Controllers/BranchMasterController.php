<?php

namespace App\Http\Controllers;

use App\Models\Branch;
use Illuminate\Http\Request;


class BranchMasterController extends Controller
{
    public function index(Branch $id)
    {

        $branches = Branch::all();
        $branches2= Branch::find($id);


       return view('Admin.Branch.index' ,compact('branches','branches2'));
    }



    public function create()
    {
        return view('Admin.Branch.create');
    }

    public function store(Request  $request, Branch $branch)
    {
        $data =$this->validate($request,[
            'branch_name'=> 'required',
            'branch_email'=> 'required',
            'branch_phone'=> 'required',
            'branch_address'=> 'required',
            'branch_city'=> 'required',
            'branch_state'=> 'required',
            'branch_pin'=> 'required',
            'branch_country'=> 'required',
        ]);

        $data = $request->all();

        if ($request->get('status')) {
            $data['status'] = "Active";
        } else {
            $data += ["status" => "Inactive"];
        }

        $branch->create($data);



//        $data = Branch::create($request->all());

        return redirect()->back()->with('success', 'branch Added');
    }

    public function updateView(Branch $branch)
    {

        return view('Admin.Branch.update' , compact('branch'));
    }

    public function update(Request $request, Branch $branch)
    {

//            $branch = Branch::find($id);

            $this->validate($request,[
            'branch_name'=> 'required',
            'branch_email'=> 'required',
            'branch_phone'=> 'required|email',
            'branch_address'=> 'required',
            'branch_city'=> 'required',
            'branch_state'=> 'required',
            'branch_pin'=> 'required',
            'branch_country'=> 'required',
        ]);

        $data = $request->all();

        if ($request->get('status')) {
            $data['status'] = "Active";
        } else {
            $data += ["status" => "Inactive"];
        }

        $branch->update($data);


//

//        Branch::whereId($id)->update($request->except('_method', '_token'));

        return redirect()->back();
    }





}
