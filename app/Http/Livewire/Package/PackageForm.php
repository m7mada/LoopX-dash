<?php

namespace App\Http\Livewire\Package;

use App\Models\Packages;
use Livewire\Component;

class PackageForm extends Component
{
    public $title, $description, $class_name, $price, $discount = null;

    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'class_name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'discount' => 'nullable|numeric|min:0',

    ];

    public function render()
    {
        return view('livewire.package.package-form');
    }



    public function store()
    {
        $data = $this->validate();


        Packages::create($data);
        $this->reset(['title', 'description', 'class_name', 'price', 'discount']);
        session()->flash('success', 'Form submitted successfully!');
    }
}
