<?php

namespace App\Http\Controllers;

use Log;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AppController extends Controller
{
    public function getWeather()
    {
        $apiKey = 'c67d396cb70ac519f249830e6b025d4e'; // Replace with your API key
        $city = 'Dhaka'; // Replace with the desired city
        $url = "https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$apiKey}&units=metric";

        $response = Http::get($url);

        if ($response->ok()) {
            return $response->json();
        }

        return ['error' => 'Unable to fetch weather data'];
    }

    public function digital_clock_1()
    {
        return view('app.digital-clock-1');
    }

    public function digital_clock_2()
    {
        return view('app.digital-clock-2');
    }

    public function digital_clock_3()
    {
        return view('app.digital-clock-3');
    }

    public function weather()
    {
        return view('app.weather');
    }

    public function banner($app_id)
    {
        $banners = Banner::select('text')->where('app_id', $app_id)->get();

        $bannerTextString = '';
        if (count($banners) > 1) {
            foreach ($banners as $banner) {
                if ($bannerTextString == '') {
                    $bannerTextString = $banner['text'];
                    continue;
                }
                $bannerTextString = $bannerTextString . '                   ' . $banner['text'];
            }
        } else {
            $bannerTextString = $banners[0]['text'];
        }

        return view('app.banner', compact('bannerTextString'));
    }
}
