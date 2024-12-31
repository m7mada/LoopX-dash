<?php

namespace App\Http\Controllers;

// use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

// use App\Models\Twin;
// use App\Models\Messages;
// use App\Models\Order;
// use MongoDB\BSON\ObjectId;
// use Carbon\Carbon;
use DB;

class ReportingController extends Controller
{
    public function customersWallet(){

        if( ! Auth::user()->is_admin ){
            return "";
        }
        $totalCridets = DB::select("SELECT SUM(order_lines.value) as total_credits FROM order_lines WHERE order_lines.order_id IN ( SELECT id FROM orders WHERE orders.is_paid = 1 AND order_lines.benefit_id = ( SELECT id FROM benefits WHERE benefits.type = 'cridet' ))");

        foreach( $totalCridets as $customerCridet ){
            echo $customerCridet->total_credits;
        }

        //dd($totalCridets[0]->total_credits);
        
    }
}
