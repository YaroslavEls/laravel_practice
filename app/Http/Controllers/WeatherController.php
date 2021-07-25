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
        $info = getInfo('http://dataservice.accuweather.com/forecasts/v1/daily/1day/'.$cityKey.'?apikey='.config('services.accuweather.key'));

        $data = (object) [
            'date' => $info['DailyForecasts'][0]['Date'],
            'city' => ucfirst( request()->city ),
            'min' => round( ( $info['DailyForecasts'][0]['Temperature']['Minimum']['Value'] - 32 ) * 5/9 ),
            'max' => round( ( $info['DailyForecasts'][0]['Temperature']['Maximum']['Value'] - 32 ) * 5/9 ),
            'status' => $info['DailyForecasts'][0]['Day']['IconPhrase']
        ];

        return view('weather-show', [
            'data' => $data
        ]);
    }
}
