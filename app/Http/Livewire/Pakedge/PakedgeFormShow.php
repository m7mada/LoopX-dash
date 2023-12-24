<?php

namespace App\Http\Livewire\Pakedge;

use Livewire\Component;
use App\Models\Pakedge;

class PakedgeFormShow extends Component
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
    public function render()
    {
        return view('livewire.pakedge.pakedge-form-show');
    }
}
