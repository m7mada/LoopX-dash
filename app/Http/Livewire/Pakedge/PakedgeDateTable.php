<?php

namespace App\Http\Livewire\Pakedge;

use App\Models\Pakedge;
use Livewire\Component;

class PakedgeDateTable extends Component
{
    public $packageToDelete;
    public $pakedges;
    public function render()
    {
        $this->pakedges = Pakedge::query()->get();

        return view('livewire.pakedge.pakedge-date-table', ['pakedges' => $this->pakedges]);
    }


    public function confirmDelete($packageId)
    {
        $this->packageToDelete = $packageId;
        $this->dispatchBrowserEvent('openDeleteModal');
    }

    public function deletePackage()
    {
        Pakedge::find($this->packageToDelete)->delete(); // Replace with your actual model

        $this->dispatchBrowserEvent('closeDeleteModal');
        $this->emit('modelSaved');
    }
}
