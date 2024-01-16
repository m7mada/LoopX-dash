<?php

namespace App\Http\Livewire\Package;

use App\Models\Packages;
use Livewire\Component;

class PackageFormEdit extends Component
{
    public $Package;
    public $title, $description, $class_name = null;

    public function mount()
    {
        $this->Package = Packages::findOrFail(request()->id);
        $this->title = $this->Package->title;
        $this->description = $this->Package->description;
        $this->class_name = $this->Package->class_name;
        $this->price = $this->Package->price;
        $this->discount = $this->Package->discount;
    }
    protected $rules = [
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'class_name' => 'required|string|max:255',
    ];

    public function render()
    {
        return view('livewire.package.package-form-edit');
    }

    public function edit()
    {
        $data = $this->validate();
        $this->Package->update($data);
        session()->flash('success', 'Form Updated successfully!');
    }
}
