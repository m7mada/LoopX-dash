<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\Pakedge;
use Livewire\Component;

class Billing extends Component
{
    public $pakedge;
    public $name , $phone , $pakedge_id ,$user_id ,$serial_number , $orders;

    public function mount(){
        $this->orders = Order::query()->with('pakedge')->get();
    }
    public function render()
    {
        $this->pakedge = Pakedge::query()->get();
        return view('livewire.billing',['pakedge' => $this->pakedge]);
    }
}

