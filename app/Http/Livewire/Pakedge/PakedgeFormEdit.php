<?php

namespace App\Http\Livewire\Pakedge;

use App\Models\Pakedge;
use Livewire\Component;

class PakedgeFormEdit extends Component
{
    public $pakedge;
    public $title, $description, $class_name, $price, $discount = null;

    public function mount()
    {
        $this->pakedge = Pakedge::findOrFail(request()->id);
        $this->title = $this->pakedge->title;
        $this->description = $this->pakedge->description;
        $this->class_name = $this->pakedge->class_name;
        $this->price = $this->pakedge->price;
        $this->discount = $this->pakedge->discount;
    }
    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'class_name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'discount' => 'nullable|numeric|min:0',
    ];

    public function render()
    {
        return view('livewire.pakedge.pakedge-form-edit');
    }

    public function edit()
    {
        $data = $this->validate();


        $this->pakedge->update($data);
        session()->flash('success', 'Form Updated successfully!');
    }
}
