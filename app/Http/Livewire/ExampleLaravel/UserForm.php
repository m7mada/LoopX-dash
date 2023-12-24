<?php

namespace App\Http\Livewire\ExampleLaravel;

use App\Models\User;
use Livewire\Component;

class UserForm extends Component
{
    public $name;
    public $email;
    public $password;
    public $location;
    public $phone;
    public $about;

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
        return view('livewire.users.user-form');
    }



    public function saveUser()
    {
        $this->validate();

        User::create([
            'name' => $this->name,
            'email' => $this->email,
            'password' => $this->password,
            'location' => $this->location,
            'phone' => $this->phone,
            'about' => $this->about,
        ]);
        $this->resetForm();
    }


    private function resetForm()
    {
        $this->name = '';
        $this->email = '';
        $this->password = '';
        $this->location = '';
        $this->phone = '';
        $this->about = '';

        session()->flash('success', 'User created successfully.');
    }
}
