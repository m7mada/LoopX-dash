<?php

namespace App\Http\Livewire;

use App\Models\Order;
use App\Models\Packages;
use Livewire\Component;

class Billing extends Component
{
    public $packages , $name , $phone , $pakedge_id ,$user_id ,$serial_number , $orders;

    public function mount(){
        $this->orders = Order::query()->with('pakedge')->get();
    }
    public function render()
    {
        $this->packages = Packages::query()
                                    ->with('benefits')
                                    ->with('packages_prices',function($q){
                                        $q->where('currency_id',1);
                                        $q->where('country_id',1);
                                    })
                                    ->with('packages_prices.currency')
                                    ->with('packages_prices.country')
                                    ->with('packages_prices.packages_prices_discounts')
                                    ->with('packages_prices.packages_prices_discounts.discount_type')
                                    ->get();

        //dd($this->packages);
        return view('livewire.billing',['packages' => $this->packages]);
    }
}

