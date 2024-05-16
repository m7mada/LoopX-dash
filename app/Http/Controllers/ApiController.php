<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function sendMessage(Request $request){
        
        return view('pages.api.index');
    }
}
