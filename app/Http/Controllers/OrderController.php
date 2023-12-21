<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{

    public function store(Request $request){


        $data = $request->validate([
            'name' => 'required|string',
            'phone' => 'required',
            'pakedge_id' => 'required|exists:pakedges,id',

        ]);

        // Create a new Order instance and save it to the database
        Order::create([
            'name' => $data['name'],
            'phone' => $data['phone'],
            'pakedge_id' => $data['pakedge_id'],
            'user_id' =>auth()->user()->id,

        ]);

        return redirect()->back();

    }
}
