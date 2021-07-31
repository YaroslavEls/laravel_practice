<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Weather extends Model
{
    public function __invoke() {
        $info = file_get_contents('http://dataservice.accuweather.com/currentconditions/v1/324505?apikey='.config('services.accuweather.key'));
        $info = json_decode($info, true);

        $data = [
            'temperature' => $info[0]['Temperature']['Metric']['Value'],
            'status' => $info[0]['WeatherText']
        ];

        Weather::first()->delete();
        Weather::create($data);
    }
}
