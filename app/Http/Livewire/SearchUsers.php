<?php

namespace App\Http\Livewire;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class SearchUsers extends Component
{

    public $search = '';
    public $mobile = '';


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

        return view('livewire.search-users', $arr);
    }

    public function setMobile($mobile)
    {
        $this->mobile = $mobile;
        $this->search = '';
    }
    public function reset(...$properties)
    {
        $this->search = '';
        $this->mobile = '';
    }
}
