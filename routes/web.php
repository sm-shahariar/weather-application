<?php

use App\Http\Controllers\WeatherController;
use Illuminate\Support\Facades\Route;

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/weather', [WeatherController::class, 'index'])->name('weather.index');
Route::get('/weather/search', [WeatherController::class, 'liveSearch'])->name('weather.search');