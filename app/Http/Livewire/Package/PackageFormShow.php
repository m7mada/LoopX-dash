<?php

namespace App\Http\Livewire\Package;

use Livewire\Component;
use App\Models\Packages;

class PackageFormShow extends Component
{
    public $Package;
    public $title, $description, $class_name, $price, $discount = null;

    public function mount()
    {
        $this->Package = Packages::findOrFail(request()->id);
        $this->title = $this->Package->title;
        $this->description = $this->Package->description;
        $this->class_name = $this->Package->class_name;
        $this->price = $this->Package->price;
        $this->discount = $this->Package->discount;
    }
    public function render()
    {
        return view('livewire.package.package-form-show');
    }
}
