<?php

namespace App\Http\Controllers\Admin\Pakedeg;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class pakedegController extends Controller
{
    public function index(){
        return view('pages.pakedge.index');
    }
}
