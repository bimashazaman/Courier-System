<?php

namespace App\Http\Controllers\stuff;

use App\Http\Controllers\Controller;
use App\Models\Branch;
use App\Models\CouriarType;
use App\Models\CourierInfo;
use App\Models\CourierProductInfo;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Milon\Barcode\DNS1D;

class CourierInfoControllerStuff extends Controller
{
    public function index(Request $request) {

        $searchtext = $request->search;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        if (!empty($start_date) && !empty($end_date)) {
            $courierList = CourierInfo::where('sender_branch_id', Auth::user()->branch_id)
                ->where(function($q) use($start_date, $end_date) {
                    $q->whereBetween('created_at', [$start_date, $end_date]);
                })
                ->orWhere('receiver_branch_id', Auth::user()->branch_id);
        } else {
            $courierList = CourierInfo::where('sender_branch_id', Auth::user()->branch_id)
                ->where(function($q) use($searchtext) {
                    $q->orWhere('invoice_id', 'LIKE', "%$searchtext%")
                        ->orWhere('payment_date', 'LIKE', "%$searchtext%")
                        ->orWhere('sender_name', 'LIKE', "%$searchtext%")
                        ->orWhere('receiver_name', 'LIKE', "%$searchtext%")
                        ->orWhere('status', 'LIKE', "%$searchtext%");
                })
                ->orWhere('receiver_branch_id', Auth::user()->branch_id)
              ;
        }
        return view('stuff.courierInfo.list', compact('courierList'));
    }


    public function create() {

        $gs = GeneralSetting::first();
        $branchList = Branch::where([['status', 'Active'], ['id', '!=', Auth::user()->branch_id]])->get();
        $courierTypeList = CouriarType::where('status', 'Active')->get();
        return view('stuff.courierInfo.add', compact('branchList', 'courierTypeList', 'gs'));
    }


    public function store(Request $request) {

        $request->validate([
            'sender_name' => 'required|max:50',
            'sender_phone' => 'required|max:50',
            'receiver_name' => 'required|max:50',
            'receiver_phone' => 'required|max:50',
            'courier_type' => 'required',
            'courier_quantity.*' => '',
            'courier_fee.*' => ''
        ]);


        $data = $request->except('_token','courier_type','courier_quantity','courier_fee');

        if (CourierInfo::first()) {

            $lastInvoice = CourierInfo::latest()->first()->id;
        } else {

            $lastInvoice = 0;
        }

        $data['invoice_id'] = $lastInvoice + 1;

        $data['status'] = 'Received';

        $data['payment_balance'] = array_sum($request->courier_fee);

        $courier_code = strtoupper(Str::random(12));

        $data['code'] = $courier_code;

        $courierInfo = CourierInfo::create($data);

        $courier_type = $request->courier_type;

        for ($i = 0; $i < count($courier_type); $i++) {
            $courierProductInfo = new CourierProductInfo();
            $courierProductInfo->courier_code = $courier_code;
            $courierProductInfo->courier_info_id = $courierInfo->id;
            $courierProductInfo->courier_type = $request->courier_type[$i];
            $courierProductInfo->courier_quantity = $request->courier_quantity[$i];
            $courierProductInfo->courier_fee = $request->courier_fee[$i];
            $courierProductInfo->save();
        }

        return redirect()->route('stuff.courier.invoice', $courierInfo->id)->withSuccess("Courier created successfully");
    }


    public function courierInvoice(CourierInfo $courierInfo) {

        $courier_code = CourierProductInfo::where('courier_info_id', $courierInfo->id)->first()->courier_code;

        $code = '<img src="data:image/png;base64,' . (new \Milon\Barcode\DNS1D)->getBarcodePNG($courier_code, 'C128') . '" alt="barcode"   />' . "<br>" . $courier_code;

        $gs = GeneralSetting::first();
        $courierProductInfoList = CourierProductInfo::where('courier_info_id', $courierInfo->id)->get();

        return view('stuff.courierInfo.invoice', compact('courierInfo', 'courierProductInfoList', 'gs', 'code'));
    }

    public function TransitCourier(Request $request) {

        $id = $request->get('id');
        $courierInfo = CourierInfo::find($id);
//        if ($request->status == "Transit") {
////            $courierInfo->payment_date = Carbon::now()->toDateString();
////            $courierInfo->payment_branch_id = Auth::user()->branch_id;
//////            $courierInfo->payment_receiver_id = Auth::user()->id;
////            $courierInfo->payment_status = "Unpaid";
//        }
//        $courierInfo->receiver_branch_staff_id = Auth::user()->id;
        $courierInfo->status = 'Transit';
        $courierInfo->save();
        return redirect()->back();
    }


    public function receiveCourier(Request $request) {

        $id = $request->get('id');
        $courierInfo = CourierInfo::find($id);
        if ($request->payment_status == "Paid") {
            $courierInfo->payment_date = Carbon::now()->toDateString();
            $courierInfo->payment_branch_id = Auth::user()->branch_id;
            $courierInfo->payment_receiver_id = Auth::user()->id;
            $courierInfo->payment_status = "Paid";
        }
        $courierInfo->receiver_branch_staff_id = Auth::user()->id;
        $courierInfo->status = 'Delivered';
        $courierInfo->save();
        return back()->withSuccess("Courier received successfully");
    }

    public function searchDeliverCourier() {

        return view('stuff.deliver.SearchDeliver');
    }

    public function showDeliverCourier(Request $request) {

        $courierList = CourierInfo::where('code', $request->search)->orWhere('receiver_phone', $request->search)->orWhere('sender_phone', $request->search)->get();

        return view('stuff.deliver.SearchDeliver', compact('courierList'));
    }

    public function notifyView() {
        return view('stuff.deliver.notifyView');
    }

    public function findCourier(Request $request) {

        $code = $request->code;

        $courier = CourierInfo::where('code', $code)->orWhere('receiver_phone', $code)->orWhere('sender_phone', $code)->with('branch')->get();

        if ($courier) {
            $response = array('output' => 'success', 'msg' => 'data found', 'courier' => $courier);
        } else {
            $response = array('output' => 'error', 'msg' => 'data not found');
        }
        return response()->json($response);
    }

    public function sendNotification(Request $request) {

        $codeList = $request->all();
        $gs = GeneralSetting::first();

        if (empty($codeList["code"])) {
            return back()->withErrors("Please add courier first");
        }

        foreach ($codeList["code"] as $invoice) {
            $sendNotify = CourierInfo::where('code', $invoice)->first();

            if ($sendNotify->receiver_email != null && $gs->email_verification == 1) {
                $to = $sendNotify->receiver_email;
                $name = $sendNotify->receiver_name;

                $subject = 'Your Courier Arrived';

                $message = "Hello Your Courier Arrived";

                send_email($to, $name, $subject, $message);
            }

            if ($sendNotify->receiver_phone != null && $gs->sms_verification == 1) {
                $to = $sendNotify->receiver_phone;
                $message = 'Hello Your Courier Arrived';
                send_sms($to, $message);
            }
        }
        return back()->withSuccess("Notification send successfully");
    }

    public function staffCasheCollection(Request $request) {

        $start_date = $request->start_date;
        $end_date = $request->end_date;

        if (!empty($start_date) && !empty($end_date)) {
            $branchIncomeList = CourierInfo::where('payment_receiver_id', Auth::user()->id)
                ->where(function($q) use($start_date, $end_date) {
                    $q->whereBetween('payment_date', [$start_date, $end_date]);
                })
                ->select(DB::raw("*,SUM(payment_balance) as total_balance"))
                ->groupBy('payment_date')
                ->paginate(10);
        } else {
            $branchIncomeList = CourierInfo::where('payment_receiver_id', Auth::user()->id)
                ->select(DB::raw("*,SUM(payment_balance) as total_balance"))
                ->groupBy('payment_date')->paginate(10);
        }

        $gs = GeneralSetting::first();

        return view('stuff.branchIncome.list', compact('branchIncomeList', 'gs'));
    }

    public function printSlipView($id) {

        $courierInfo = CourierInfo::find($id);
        $courier_code = CourierProductInfo::where('courier_info_id', $courierInfo->id)->first()->courier_code;
        $code = '<img src="data:image/png;base64,' . (new \Milon\Barcode\DNS1D)->getBarcodePNG($courier_code, 'C128') . '" alt="barcode"   />' . "<br>" . $courier_code;
        $gs = GeneralSetting::first();

        return view('stuff.courierInfo.slip', compact('courier_code', 'code', 'gs', 'courierInfo'));
    }

    public function paidCourier(Request $request) {

        $id = $request->get('id');
        $courierInfo = CourierInfo::find($id);
        $courierInfo->payment_date = Carbon::now()->toDateString();
        $courierInfo->payment_branch_id = Auth::user()->branch_id;
        $courierInfo->payment_receiver_id = Auth::user()->id;
        $courierInfo->payment_status = "Paid";
        $courierInfo->save();
        return back()->withSuccess("Courier payment successfully");
    }
}
