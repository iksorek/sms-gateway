<?php

namespace App\Http\Controllers;

use App\Models\Sms;
use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\ViewErrorBag;
use Twilio\Rest\Client;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;




    public function updateMobileNo(Request $request)
    {
        if($request->input('prefix') === '+44') {
            $rules = ["newmobile" => 'required|size:10|numeric',
                'prefix'=>'required'];
        }
        if($request->input('prefix') === '+48') {
            $rules = ["newmobile" => 'required|size:9|numeric',
                'prefix'=>'required'];
        }
        $request->validate($rules);
        $me = Auth::user();
        $me->mobile = $request->input('newmobile');
        $me->prefix = $request->input('prefix');
        $me->verification_code = rand(1000, 9999);
        $me->mobile_verified_at = null;
        $this->sendSms("New verification code: " . $me->verification_code, $me->prefix.$me->mobile);
        $me->save();
        request()->session()->flash('flash.banner', 'New mobile number saved. You have to validate it');
        return Redirect::route('profile.show');
    }

    public static function sendSms($message, $recipient)
    {
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($recipient,
            [
                'from' => $twilio_number,
                'body' => $message,
            ]);
    }

    public function resendCode()
    {
        $me = Auth::user();
        $me->verification_code = rand(1000, 9999);
        $this->sendSms("New verification code: " . $me->verification_code, $me->prefix.$me->mobile);
        $me->save();
        return Redirect::route('profile.show');
    }

    public function verifycode(Request $request)
    {
        $request->validate([
            'verification_code' => 'numeric|required',
        ]);
        $me = Auth::user();
        if ($request->input('verification_code') == $me->verification_code) {
            $me->mobile_verified_at = now();
            $me->save();
            request()->session()->flash('flash.banner', 'Mobile number has been verified!');
        } else {
            request()->session()->flash('flash.banner', "Wrong code!");
            request()->session()->flash('flash.bannerStyle', 'danger');
        }

        return Redirect::route('profile.show');
    }
}
