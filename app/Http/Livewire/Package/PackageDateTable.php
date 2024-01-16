<?php

namespace App\Http\Livewire\Package;

use App\Models\Packages;
use Livewire\Component;

class PackageDateTable extends Component
{
    public $packageToDelete;
    public $Packages;
    public function render()
    {
        $this->packages = Packages::query()->get();

        return view('livewire.package.package-date-table', ['packages' => $this->packages]);
    }


    public function confirmDelete($packageId)
    {
        $this->packageToDelete = $packageId;
        $this->dispatchBrowserEvent('openDeleteModal');
    }

    public function deletePackage()
    {
        Packages::find($this->packageToDelete)->delete(); // Replace with your actual model

        return redirect()->route('Package');}
}
