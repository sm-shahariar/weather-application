<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Carbon\Carbon;

class WeatherController extends Controller
{
    public function index(Request $request)
    {
        $city = $request->input('city', 'Dhaka');  // Default city
        $apiKey = env('OPENWEATHER_API_KEY');

        // Check if API key is set
        if (!$apiKey) {
            return view('weather', [
                'error' => 'OpenWeather API key not configured'
            ]);
        }

        try {
            // Current weather
            $currentWeatherResponse = Http::get("https://api.openweathermap.org/data/2.5/weather", [
                'q' => $city,
                'appid' => $apiKey,
                'units' => 'metric'
            ]);

            if (!$currentWeatherResponse->successful()) {
                return view('weather', [
                    'city' => $city,
                    'error' => 'City not found or API error'
                ]);
            }

            $currentWeather = $currentWeatherResponse->json();

            // 5 days forecast
            $forecastResponse = Http::get("https://api.openweathermap.org/data/2.5/forecast", [
                'q' => $city,
                'appid' => $apiKey,
                'units' => 'metric'
            ]);

            $dailyForecasts = [];
            
            if ($forecastResponse->successful()) {
                $forecast = $forecastResponse->json();
                
                // Filter forecast to get one record per day
                $dailyForecasts = collect($forecast['list'] ?? [])->filter(function($item) {
                    return str_contains($item['dt_txt'], '12:00:00');
                })->map(function($item) {
                    return [
                        'date' => Carbon::parse($item['dt_txt'])->format('D, d M Y'),
                        'temp' => round($item['main']['temp']),
                        'condition' => $item['weather'][0]['main'],
                        'icon' => $item['weather'][0]['icon']
                    ];
                })->values()->toArray();
            }

            return view('weather', [
                'city' => $city,
                'currentWeather' => $currentWeather,
                'dailyForecasts' => $dailyForecasts
            ]);

        } catch (\Exception $e) {
            return view('weather', [
                'city' => $city,
                'error' => 'An error occurred while fetching weather data'
            ]);
        }
    }

    public function liveSearch(Request $request){
        $city = $request->input('city', '');
        $apiKey = env('OPENWEATHER_API_KEY');

        if (!$apiKey) {
            return view('weather', [
                'error' => 'OpenWeather API key not configured'
            ]);
        }

        // Current weather 
        $current = Http::get("https://api.openweathermap.org/data/2.5/weather", [
            'q' => $city,
            'appid' => $apiKey,
            'units' => 'metric'
        ])->json();

        return response()->json($current);

    }
}