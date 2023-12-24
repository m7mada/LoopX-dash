<?php

namespace App\Http\Livewire\ExampleLaravel;

use App\Models\User;
use Livewire\Component;

class UserFormEdit extends Component
{
    public $user;
    public $name;
    public $email;
    public $password;
    public $location;
    public $phone;
    public $about;

    public function mount(){
        $this->user = User::findOrFail(request()->id);
        $this->name = $this->user->name;
        $this->email = $this->user->email;

        $this->location = $this->user->location;
        $this->phone = $this->user->phone;
        $this->about = $this->user->about;
    }
    protected $rules = [
        'name' => 'required|string',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|min:8',
        'location' => 'required|string',
        'phone' => 'required|string',
        'about' => 'nullable|string',
    ];
    public function render()
    {
        return view('livewire.users.user-form-edit');
    }

    public function update()
    {
        $this->validate();

        $this->user->update([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'location' => $this->location,
            'phone' => $this->phone,
            'about' => $this->about,
        ]);
        session()->flash('success', 'User updated successfully.');
    }


}
