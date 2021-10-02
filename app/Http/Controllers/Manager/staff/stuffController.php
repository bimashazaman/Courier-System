<?php

namespace App\Http\Controllers\Manager\staff;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\CouriarType;
use App\Models\GeneralSetting;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Intervention\Image\Facades\Image;
use Symfony\Component\Console\Input\Input;

class stuffController extends Controller
{

    public function index(Request $request) {
        $branch = Branch::all();
        $searchtext = $request->search;
        if (!empty($searchtext)) {
            $branchStaffList = User::where([['type', 'Staff'], ['branch_id', Auth::user()->branch_id]])
                ->where(function($q) use($searchtext) {
                    $q->orWhere('name', 'LIKE', "%$searchtext%")
                        ->orWhere('email', 'LIKE', "%$searchtext%")
                        ->orWhere('phone', 'LIKE', "%$searchtext%");
                })
                ;
        } else {
            $branchStaffList = User::where([['role_id', '2'], ['branch_id', Auth::user()->branch_id]]);

        }

        return view('Manager.staff.list', compact('branchStaffList' , 'branch'));
    }


    public function create() {
        $branch = Branch::all();
        $user = User::all();
        return view('Manager.staff.create' ,compact('branch', 'user'));
    }


    public function store(Request $request, User $manager) {
        $request->validate([
            'branch_id'=>'required',
            'role_id'=>'',
            'type'=> 'required',
            'name'=>'required',
            'email'=>'required',
            'phone'=>'required',
            'image'=>'image|mimes:jpeg,png,jpg|max:5120',
            'status'=>'',
            'password'=>'required',

        ]);
        $data = $request->all();


        if ($request->hasFile('image')) {
            $image = $request->image;
            $imageObj = Image::make($image);
            $imageObj->save('assets/admin/img/branchManager/' . $image->hashname());
            $data['image'] = $image->hashname();
        }


        if ($request->get('status')) {
            $data['status'] = "Active";
        } else {
            $data += ["status" => "Inactive"];
        }
        //password hash make
        $data['password'] = Hash::make($request->get('password'));

        $manager->create($data);

        return back()->withSuccess('Branch Manager created successfully');
    }

    public function dashboard() {

        $gs = GeneralSetting::first();
        $branchList = Branch::where([['status', 'Active'], ['id', '!=', Auth::user()->branch_id]])->get();
        $courierTypeList = CouriarType::where('status','Active')->get();

        return view('stuff.courierInfo.add', compact('branchList', 'courierTypeList', 'gs'));
    }

    public function profileView() {

        return view('staff/profile');

    }

    public function updateProfile(Request $request) {
        $request->validate([
            'name' => 'required|max:50',
            'email' => ['required',
                Rule::unique('users')->ignore(Auth::user()->id), 'email'
            ],
            'phone' => ['required',
                Rule::unique('users')->ignore(Auth::user()->id), 'numeric'
            ],
            'image' => 'image|mimes:jpeg,png,jpg|max:5120',
        ]);

        $profile = Auth::user();

        if ($request->hasFile('image')) {
            if (Auth::user()->image) {
                unlink('assets/staff/img/profile/' . Auth::user()->image);
            }
            $image = $request->image;
            $imageObj = Image::make($image);
            $imageObj->save('assets/staff/img/profile/' . $image->hashname());
            $profile->image = $image->hashname();
        }

        $profile->name = $request->get('name');
        $profile->email = $request->get('email');
        $profile->phone = $request->get('phone');

        $profile->save();

        return back()->withSuccess('Profile updated successfully');
    }

    public function changePassword() {
        return view('staff/changePassword');
    }

    public function updatePassword(Request $request) {
        $niceName = [
            'oldword' => 'Current Password',
            'newword' => 'New Password',
            'newword_confirmation' => 'Re-type password',
        ];
        $rules = [
            'oldword' => 'required',
            'newword' => 'required|min:4|confirmed',
            'newword_confirmation' => 'required',
        ];
        $customMessages = [
            'required' => 'The :attribute field is required.',
            'min' => 'Password must be 4 char',
        ];

        $this->validate($request, $rules, $customMessages, $niceName);

        $errors = [];
        //checking current password incorrect or correct
        $profile = Auth::user();
        if (!Hash::check(Input::get('oldword'), $profile->password)) {
            $errors['oldword'] = "Currernt password incorrect";
        }
        //checking new password is same as old password
        if (Hash::check(Input::get('newword'), $profile->password)) {
            $errors['newword'] = "This password is already used before. Try with a different one";
        }
        //find erros & redirect back with error message
        if (count($errors) > 0) {
            return redirect()->back()->withInput()->withErrors($errors)->withError('errorArray', 'Array Error Occured');
        } else {
            //bcrypt passwrod
            $profile->password = bcrypt(Input::get('newword'));
            $profile->save();
            return back()->withSuccess('Password updated successfully');
        }
    }

    public function branchList() {
        $branchList = Branch::all()->where('status', 'Active');
        return view('staff.allbranch', compact('branchList'));
    }

}
