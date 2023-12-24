<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrderDatatable extends Component
{
    public $orders;
    public function render()
    {
        $this->orders = Order::query()->with(['user','pakedge'])->get();
        return view('livewire.order-datatable',['orders' =>$this->orders]);
    }
    public function updatePayment($userId)
    {
        $order = Order::find($userId);

        if ($order) {
            // Toggle the payment status
            $order->payment = ($order->payment == 'pending') ? 'completed' : 'pending';
            $order->save();
            session()->flash('success', 'updated successfully!');
        }
    }
}
