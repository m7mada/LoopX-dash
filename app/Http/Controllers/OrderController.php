<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderLine;
use App\Models\PackagesPrice;
use App\Models\PackagesBenefit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

class OrderController extends Controller
{

    public function store(Request $request){


        $data = $request->validate([
            'name' => 'required|string',
            'phone' => 'required',
            'package_price_id' => 'required|exists:packages_prices,id',

        ]);
        
        $packcagePrice = PackagesPrice::find($data['package_price_id']) ;
        
        $insertedOrder = Order::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'user_id' =>auth()->user()->id,
            'payment_methods_id'=>(int) 1,
            'is_paid'=>(int) 0,
            'net_paid'=> $packcagePrice->price,

        ]);


        foreach ( PackagesBenefit::where('package_id',$packcagePrice->package_id)->get() as $line){
            $orderLines[] = [
                'order_id'=> $insertedOrder->id,
                'referance_package_id'=> $packcagePrice->package_id,
                'benefit_id'=> $line->benefit_id,
                'value'=> $line->value,
                'expire_time'=> ( $line->benefit->type == 'saas') ? Carbon::now()->addMonth($line->value) : null,
            ];
        }

        $insertedOrderLines = OrderLine::insert($orderLines);

        return redirect()->back();

    }
}
