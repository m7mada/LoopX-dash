<?php

namespace App\Http\Livewire\ExampleLaravel;

use Livewire\Component;
use Auth ;

class UserManagement extends Component
{
    public function render()
    {
        return view('livewire.users.user-management',['users'=>[Auth::user()]]);
    }
}
