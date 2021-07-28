<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Exception;
use Illuminate\Validation\ValidationException;

class WeatherController extends Controller
{
    public function create()
    {
        return view('weather');
    }

    public function show()
    {
        request()->validate([
            'city' => ['required']
        ]);

        function getInfo($url) {
            $info = file_get_contents($url);
            if ($info === '[]') {
                throw ValidationException::withMessages([
                    'city' => 'City not found'
                ]);
            };
            return json_decode($info, true);
        }

        $info = getInfo('http://dataservice.accuweather.com//locations/v1/cities/search?apikey='.config('services.accuweather.key').'&q='.request()->city);
        $cityKey = $info[0]['Key'];
        $info = getInfo('http://dataservice.accuweather.com/currentconditions/v1/'.$cityKey.'?apikey='.config('services.accuweather.key'));

        $data = (object) [
            'city' => ucfirst( request()->city ),
            'temperature' => $info[0]['Temperature']['Metric']['Value'],
            'status' => $info[0]['WeatherText']
        ];

        return view('weather-show', [
            'data' => $data
        ]);
    }
}
