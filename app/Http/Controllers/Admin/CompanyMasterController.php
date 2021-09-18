<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\CompanyMaster;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;


class CompanyMasterController extends Controller
{
    public function index()
    {
        $companies = CompanyMaster::all();
        if (count($companies) > 0)
        {
            $company = CompanyMaster::find(1);
            return view('Admin.Company.index', compact('companies' , 'company'));
        }
        else
        {
            return view('Admin.Company.index', compact('companies'));
        }

    }
    public function store(Request  $request )
    {
//            $this->validate([
//            'company_name'  => 'required',
//            'company_logo' => 'required',
//            'company_address' => 'required',
//            'company_city' => 'required',
//            'company_state' => 'required',
//            'company_pin' => 'required',
//            'company_country' => 'required',
//            ' company_phone' => 'required',
//            'company_email' => 'required',
//            'company_gst' => 'required',
//
//        ]);





       $company = new CompanyMaster;

        $slug = Str::slug($request->company_name);
        $image = $request->file('company_logo');

        if (isset($image))
        {
            $date = Carbon::now()->toDateString();

            $imageName = $slug . '-'. $date . '-' . uniqid() . '.'.$image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('company'))
            {
                Storage::disk('public')->makeDirectory('company');
            }

            $companyLogo = Image::make($image)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('company/'.$imageName, $companyLogo);
        }

        else
        {
            $imageName = 'default.png';
        }


        $company->company_name = $request->company_name;
        $company->company_address = $request->company_address;
        $company->company_logo = $imageName;
        $company->company_city = $request->company_city;
        $company->company_state = $request->company_state;
        $company->company_pin = $request->company_pin;
        $company->company_country = $request->company_country;
        $company->company_phone = $request->company_phone;
        $company->company_email = $request->company_email;
        $company->company_gst = $request->company_gst;

        $company->save();

        return redirect()->back()->with('success', 'Company Added');


    }



    public  function update(Request  $request ){

        $company = CompanyMaster::find(1);

        $slug = Str::slug($request->company_name);
        $image = $request->file('company_logo');

        if (isset($image))
        {
            $date = Carbon::now()->toDateString();

            $imageName = $slug . '-'. $date . '-' . uniqid() . '.'.$image->getClientOriginalExtension();

            if (!Storage::disk('public')->exists('company'))
            {
                Storage::disk('public')->makeDirectory('company');
            }

            $companyLogo = Image::make($image)->save($image->getClientOriginalExtension());
            Storage::disk('public')->put('company/'.$imageName, $companyLogo);
        }

        else
        {
            $imageName = 'default.png';
        }


        $company->company_name = $request->company_name;
        $company->company_address = $request->company_address;
        $company->company_logo = $imageName;
        $company->company_city = $request->company_city;
        $company->company_state = $request->company_state;
        $company->company_pin = $request->company_pin;
        $company->company_country = $request->company_country;
        $company->company_phone = $request->company_phone;
        $company->company_email = $request->company_email;
        $company->company_gst = $request->company_gst;

        $company->save();

        return redirect()->back()->with('success', 'Company updated');


    }


}
