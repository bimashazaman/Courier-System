<?php

namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;
use App\Models\CourierInfo;
use App\Models\CourierProductInfo;
use App\Models\GeneralSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Milon\Barcode\DNS1D;
use Illuminate\Database\Eloquent\Builder;

class CourierInfoController extends Controller
{
    public function departureBranchCourierList(Request $request) {
        $searchtext = $request->search;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        if (!empty($start_date) && !empty($end_date)) {
            $courierList = CourierInfo::where([['sender_branch_id', Auth::user()->branch_id], ['status', 'Received']])
                ->where(function($q) use($start_date, $end_date) {
                    $q->whereBetween('created_at', [$start_date, $end_date]);
                });

        } else {
            $courierList = CourierInfo::where([['sender_branch_id', Auth::user()->branch_id], ['status', 'Received']])
                ->where(function($q) use($searchtext) {
                    $q->orWhere('invoice_id', 'LIKE', "%$searchtext%")
                        ->orWhere('payment_date', 'LIKE', "%$searchtext%")
                        ->orWhere('sender_name', 'LIKE', "%$searchtext%")
                        ->orWhere('receiver_name', 'LIKE', "%$searchtext%")
                        ->orWhere('code', 'LIKE', "%$searchtext%");
                });
        }
        return view('Manager.courierInfo.departureCourierList', compact('courierList'));
    }


    public function upcomingBranchCourierList(Request $request) {
        $searchtext = $request->search;
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        if (!empty($start_date) && !empty($end_date)) {
            $courierList = CourierInfo::where([['receiver_branch_id', Auth::user()->branch_id], ['status', 'Received']])
                ->where(function($q) use($start_date, $end_date) {
                    $q->whereBetween('created_at', [$start_date, $end_date]);
                });

        } else {
            $courierList = CourierInfo::where([['receiver_branch_id', Auth::user()->branch_id], ['status', 'Received']])
                ->where(function($q) use($searchtext) {
                    $q->orWhere('invoice_id', 'LIKE', "%$searchtext%")
                        ->orWhere('payment_date', 'LIKE', "%$searchtext%")
                        ->orWhere('sender_name', 'LIKE', "%$searchtext%")
                        ->orWhere('receiver_name', 'LIKE', "%$searchtext%")
                        ->orWhere('code', 'LIKE', "%$searchtext%");
                });

        }

        return view('Manager.courierInfo.upcomingCourierList', compact('courierList'));
    }


    public function courierInvoice(CourierInfo $courierInfo) {

        $courier_code = CourierProductInfo::where('courier_info_id', $courierInfo->id)->first()->courier_code;
        $code = '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($courier_code, 'C128') . '" alt="barcode"   />' . "<br>" . $courier_code;

        $gs = GeneralSetting::first();

        $courierProductInfoList = CourierProductInfo::where('courier_info_id', $courierInfo->id)->get();

        return view('Manager.courierInfo.invoice', compact('courierInfo', 'courierProductInfoList', 'gs', 'code'));
    }

    public function upcomingCourierInvoice(CourierInfo $courierInfo) {
        $gs = GeneralSetting::first();
        $courierProductInfoList = CourierProductInfo::where('courier_info_id', $courierInfo->id)->get();
        return view('Manager.courierInfo.upcomingCourierInvoice', compact('courierInfo', 'courierProductInfoList', 'gs'));
    }

    public function printSlipView($id) {
        $courierInfo = CourierInfo::find($id);
        $courier_code = CourierProductInfo::where('courier_info_id', $courierInfo->id)->first()->courier_code;
        $code = '<img src="data:image/png;base64,' . DNS1D::getBarcodePNG($courier_code, 'C128') . '" alt="barcode"   />' . "<br>" . $courier_code;
        $gs = GeneralSetting::first();
        return view('Manager.courierInfo.slip', compact('courier_code', 'code', 'gs', 'courierInfo'));
    }




}
