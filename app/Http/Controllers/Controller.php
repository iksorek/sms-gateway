<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;
use Twilio\Rest\Client;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function updateMobileNo(Request $request)
    {
        $request->validate([
            "newmobile" => 'required|min:5|max:12',
        ]);
        $me = Auth::user();
        $me->mobile = $request->input('newmobile');
        $this->sendMessage('Test', '+447533078790');

        //todo add php8.0-curl in the system, as will not work without it
        $me->save();
        Session::flash('info', 'Mobile number saved');
        return Redirect::route('dashboard');
    }
    private function sendMessage($message, $recipients)
    {
        $account_sid = getenv("TWILIO_SID");
        $auth_token = getenv("TWILIO_AUTH_TOKEN");
        $twilio_number = getenv("TWILIO_NUMBER");
        $client = new Client($account_sid, $auth_token);
        $client->messages->create($recipients,
            ['from' => $twilio_number, 'body' => $message] );
    }
}
