<?php

namespace App\Http\Controllers;

use App\Models\Weather;

class WeatherController extends Controller
{
    public function create()
    {
        return view('weather', [
            'data' => Weather::first()
        ]);
    }
}
