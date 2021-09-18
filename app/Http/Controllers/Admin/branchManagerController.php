<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;


use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Branch;
use Illuminate\Support\Facades\Hash;
use App\Models\CourierInfo;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class branchManagerController extends Controller
{
    public function index(Request $request) {

        $searchtext = $request->search;
        $branchManagerList = User::where('type', '=', 'Manager')
            ->where(function($q) use($searchtext) {
                $q->orWhere('name', 'LIKE', "%$searchtext%")
                    ->orWhere('email', 'LIKE', "%$searchtext%")
                    ->orWhere('phone', 'LIKE', "%$searchtext%");
            })
            ->paginate(10);
        return view('Manager.list', compact('branchManagerList'));
    }



    public function create() {
        $user = User::all();
        $branchList = Branch::all()->where('status', 'Active');
        return view('Manager.add', compact('branchList' ,'user'));
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








    public function companyIncome() {
        $branchList = Branch::all();
        return view('Admin.companyIncome.branchList', compact('branchList'));
    }



    public function branchIncome(Request $request, $branch) {

        $staff = $request->staff_id;
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        if (!empty($start_date) && !empty($end_date) && !empty($staff)) {
            $branchIncomeList = CourierInfo::where('payment_branch_id', $branch)
                ->where(function($q) use($start_date, $end_date, $staff) {
                    $q->whereBetween('payment_date', [$start_date, $end_date])
                        ->where('payment_receiver_id', $staff);
                })
                ->select(DB::raw("*,SUM(payment_balance) as total_balance"))
                ->groupBy('payment_date')->paginate(10);
        } elseif (!empty($start_date) && !empty($end_date)) {
            $branchIncomeList = CourierInfo::where('payment_branch_id', $branch)
                ->where(function($q) use($start_date, $end_date) {
                    $q->whereBetween('payment_date', [$start_date, $end_date]);
                })
                ->select(DB::raw("*,SUM(payment_balance) as total_balance"))
                ->groupBy('payment_date')->paginate(10);
        } elseif (!empty($staff)) {
            $branchIncomeList = CourierInfo::where('payment_branch_id', $branch)
                ->where(function($q) use($staff) {
                    $q->where('payment_receiver_id', $staff);
                })
                ->select(DB::raw("*,SUM(payment_balance) as total_balance"))
                ->groupBy('payment_date')->paginate(10);
        } else {
            $branchIncomeList = CourierInfo::where('payment_branch_id', $branch)
                ->select(DB::raw("*,SUM(payment_balance) as total_balance"))
                ->groupBy('payment_date')->paginate(10);
        }

        $branchName = Branch::find($branch);

        $branchStaff = User::where([['branch_id', $branch], ['type', 'Staff']])->get();

        return view('Admin.companyIncome.branchIncomeList', compact('branchIncomeList', 'branchName', 'branch', 'branchStaff'));
    }

    public function dateWiseBranchIncome($branch, $date) {
        $branchIncomeList = CourierInfo::where('payment_branch_id', $branch)->whereDate('payment_date', $date)
            ->select(DB::raw("*,SUM(payment_balance) as total_balance"))
            ->groupBy('payment_receiver_id')->paginate(10);
        $branchName = Branch::find($branch);
        return view('Admin.companyIncome.dateIncomeList', compact('branchIncomeList', 'branchName', 'branch'));
    }

    public function staffWiseBranchIncome($branch, $staff) {

        $branchIncomeList = CourierInfo::where([['payment_branch_id', $branch], ['payment_receiver_id', $staff]])
            ->select(DB::raw("*,SUM(payment_balance) as total_balance"))
            ->groupBy('payment_date')->paginate(10);

        $branchName = Branch::find($branch);

        return view('Admin.companyIncome.staffIncomeList', compact('branchIncomeList', 'branchName', 'branch'));
    }




}
