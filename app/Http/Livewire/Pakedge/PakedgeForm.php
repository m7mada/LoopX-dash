<?php

namespace App\Http\Livewire\Pakedge;

use App\Models\Pakedge;
use Livewire\Component;

class PakedgeForm extends Component
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
        return view('livewire.pakedge.pakedge-form');
    }



    public function store()
    {
        $data = $this->validate();


        Pakedge::create($data);
        $this->reset(['title', 'description', 'class_name', 'price', 'discount']);
        session()->flash('success', 'Form submitted successfully!');
    }
}
