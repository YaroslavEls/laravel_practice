<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TrafficController extends Controller
{
    public function create()
    {
        return view('traffic');
    }
}
