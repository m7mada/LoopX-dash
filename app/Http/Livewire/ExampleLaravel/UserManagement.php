<?php

namespace App\Http\Livewire\ExampleLaravel;

use App\Models\User;
use Livewire\Component;
use Auth ;

class UserManagement extends Component
{
    public $users;
    public function render()
    {
        $this->users = User::query()->get();
        return view('livewire.users.user-management',['users'=>$this->users]);
    }
    public function delete($userId)
    {
        User::find($userId)->delete();
    }
}
