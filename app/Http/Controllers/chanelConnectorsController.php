<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class chanelConnectorsController extends Controller
{
    public function connectorCallback( Request $request){

        return $request; 
    }

    public function successConnection( Request $request){

        return $request; 
    }
}
