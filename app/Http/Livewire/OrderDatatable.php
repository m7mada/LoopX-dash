<?php

namespace App\Http\Livewire;

use App\Models\Order;
use Livewire\Component;

class OrderDatatable extends Component
{
    public $orders;
    public function render()
    {
        $this->orders = Order::query()
                            ->with('user')
                            ->with('order_lines')
                            ->with('order_lines.benefit')
                            ->with('order_lines.packages_price')
                            ->get();

        return view('livewire.order-datatable',['orders' =>$this->orders]);
    }
    public function updatePayment($orderId, $payment)
    {
        $order = Order::find($orderId);

        if ($order) {
            $order->is_paid = $payment;
            $order->save();
            session()->flash('success', 'updated successfully!');
        }
    }
}
