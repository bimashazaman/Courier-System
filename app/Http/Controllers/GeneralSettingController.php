<?php

namespace App\Http\Controllers;

use App\Models\GeneralSetting;
use Illuminate\Http\Request;

class GeneralSettingController extends Controller
{
    public function basicSetting() {

        $settings = GeneralSetting::first();

        return view('Admin.settings.generalSettings', compact('settings'));
    }

    public function updateBasicSetting(Request $request, GeneralSetting $basicSetting) {

        $rules = [
            'title' => 'required',
            'logo' => 'image|mimes:jpeg,png,jpg|max:300',
        ];

        $messages = [
            'required' => 'The :attribute field is required.',
        ];

        $this->validate($request, $rules, $messages);

        $data = $request->all();

        if ($request->get('registration_verification')) {
            $data['registration_verification'] = "1";
        } else {
            $data += ["registration_verification" => "0"];
        }

        if ($request->get('email_verification')) {
            $data['email_verification'] = "1";
        } else {
            $data += ["email_verification" => "0"];
        }

        if ($request->get('sms_verification')) {
            $data['sms_verification'] = "1";
        } else {
            $data += ["sms_verification" => "0"];
        }

        $basicSetting->update($data);

        return back()->withSuccess('Information updated successfully');
    }


    public function smsSetting() {
        $settings = GeneralSetting::first();
        return view('Admin.settings.smsSettings', compact('settings'));
    }

    public function updateSmsSetting(Request $request, GeneralSetting $smsSetting) {
        $data = $request->all();

        $smsSetting->update($data);

        return back()->withSuccess('Information updated successfully');
    }

    public function emailSetting() {
        $settings = GeneralSetting::first();

        return view('Admin.settings.emailSettings', compact('settings'))->withSuccess('error');
    }

    public function updateEmailSetting(Request $request, GeneralSetting $emailSetting) {

        $request->validate([
            'email_sent_from' => 'email',
        ]);


        $data = $request->all();
        $emailSetting->update($data);
        return back()->withSuccess('Information updated successfully');
    }


}
