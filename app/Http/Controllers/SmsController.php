<?php

namespace App\Http\Controllers;

use App\Jobs\RefreshSmsStatus;
use App\Models\Sms;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Redis;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;

class SmsController extends Controller
{
    public function sendMessage(Request $request)
    {
        $data = $request->validate([
            'recipient' => 'required',
            'message' => 'required|max:140'
        ]);
        Auth::user()->Sms()->create($data);
        request()->session()->flash('flash.banner', 'Message in queue.');
        Cache::add('sms-' . Auth::id(), now(), 15);
        return redirect(route('messages'));

    }

    public function ShowSmsForm()
    {
        if (Auth::user()->mobile && Auth::user()->mobile_verified_at) {
            return view('messages')->with('done', Cache::get('sms-' . Auth::id()));
        } else {
            request()->session()->flash('flash.banner', 'You have to provide valid mobile number to get full access.');
            return Redirect::route('profile.show');
        }
    }

    public function log()
    {
        RefreshSmsStatus::dispatch();
        $messages = Sms::with(['User', 'User'])->orderBy('created_at', 'DESC')->paginate(10);
        return view('log')->with(['messages' => $messages]);
    }


}
