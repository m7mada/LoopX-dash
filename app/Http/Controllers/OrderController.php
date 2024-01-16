<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Pakedge ;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function store(Request $request){


        dd($request->all());
        $data = $request->validate([
            'name' => 'required|string',
            'phone' => 'required',
            'pakedge_id' => 'required|exists:packages,id',

        ]);

        
        // Create a new Order instance and save it to the database
        Order::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'pakedge_id' => $data['pakedge_id'],
            'user_id' =>auth()->user()->id,
            'messages_ammount'=>Pakedge::select('messages')->find($data['pakedge_id'])->messages,

        ]);

        return redirect()->back();

    }
}
