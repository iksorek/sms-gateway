<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Livewire\Component;

class SendMessage extends Component
{



    public $message;
    public $recipient;
    public $search = '';

    protected $rules = [
        'recipient' => 'required|numeric|digits:11',
        'message' => 'required|max:140|min:3'
    ];


    public function submit(){
        $this->validate();

        Auth::user()->Sms()->create([
            'recipient' => $this->recipient,
            'message' => $this->message,
        ]);
        request()->session()->flash('flash.banner', 'Message has been add to our queue.');
        Cache::add('sms-' . Auth::id(), now(), 15);
        $this->redirect(route('log'));
    }


    public function render()
    {
        if ($this->search != '' && !empty($this->search)) {
            $arr = [
                'users' => User::where('name', 'LIKE', "%$this->search%")->get(),
            ];
        } else {
            $arr = [
                'users' => User::where('id', -1),
            ];
        }
        return view('livewire.send-message', $arr);
    }

    public function setMobile($recipient)
    {
        $this->recipient = $recipient;
        $this->search = '';
    }
    public function reset(...$properties)
    {
        $this->search = '';
        $this->recipient = '';
    }




}
