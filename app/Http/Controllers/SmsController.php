<?php

namespace App\Http\Controllers;

use App\Models\Sms;
use App\Models\User;
use DebugBar\Bridge\SlimCollector;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;

class SmsController extends Controller
{
    public function sendMessage(Request $request)
    {
        $request->validate([
            'recipient' => 'required|numeric|digits:11',
            'message' => 'required|max:140'
        ]);
        $message = new Sms();
        $message->user_id = Auth::id();
        $message->recipient = $request->input('recipient');
        $message->message = $request->input('message');
        $message->status = 'unknown';
        $message->status = 'unknown';
        $message->save();
        Session::flash('info', 'Message saved, waiting to be send');
        Cache::add('sms', now(), 15);
        return redirect(route('messages'));

    }

    public function ShowSmsForm()
    {
        if (Auth::user()->mobile && Auth::user()->mobile_verified_at) {
            return view('messages')->with('done', Cache::get('sms-'.Auth::id()));
        } else {
            return Redirect::route('dashboard')->with('info', 'Your account is not active yet.');
        }


    }
    public function log(){
        $messages = Sms::with(['User'])->orderBy('created_at', 'DESC')->get();


        return view('log')->with(['messages'=>$messages]);
    }
}
