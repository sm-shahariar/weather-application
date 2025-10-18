@extends('layouts.apps')
@section('content')

<div class="container">

    <!-- Hidden div to pass php data to js  -->
    <div id="weather-data"
         data-current='@json($currentWeather ?? [])'
         data-forecast='@json($dailyForecasts ?? [])'
         style="display: none;"></div>

    <div class="header">
        <div class="logo">
            <i class="fas fa-cloud-sun"></i>
            <span>WeatherCast</span>
        </div>
        <div class="search-box">
            <input type="text" placeholder="Search for a city..." id="city-input">
            <button id="search-btn"><i class="fas fa-search"></i> Search</button>
        </div>
    </div>

    <div class="weather-card">
        <div class="current-weather">
            <div class="location-info">
                <h1 id="city-name">{{$city}},
                    @if(isset($currentWeather['sys']['country']) && $currentWeather['sys']['country'] == 'BD')
                    <span>Bangladesh</span>
                    @endif

                </h1>
                <div class="date" id="current-date">
                    {{ isset($currentWeather['dt']) ? \Carbon\Carbon::createFromTimestamp($currentWeather['dt'])->format('l, d M Y') : '' }}
                </div>

            </div>
            <div class="weather-info">
                <div class="weather-icon">
                    <i class="fas fa-sun" id="weather-icon"></i>
                </div>
                <div class="temperature" id="temperature">{{ $currentWeather['main']['temp'] }}</div>
                <div class="weather-condition" id="weather-condition">{{ $currentWeather['weather'][0]['main'] }}</div>
            </div>
        </div>

        <div class="forecast-toggle">
            <button class="toggle-btn" id="forecast-toggle">
                <i class="fas fa-calendar-alt"></i>
                <span>5-Day Forecast</span>
                <i class="fas fa-chevron-down" id="toggle-arrow"></i>
            </button>
        </div>

        <div class="forecast-container" id="forecast-container">
            <!-- Forecast days will be dynamically added here -->
        </div>

        <div class="weather-details">
            <div class="detail-card">
                <div class="detail-icon">
                    <i class="fas fa-wind"></i>
                </div>
                <div class="detail-info">
                    <h3>Wind Speed</h3>
                    <p id="wind-speed">{{ $currentWeather['wind']['speed'] }}</p>
                </div>
            </div>
            <div class="detail-card">
                <div class="detail-icon">
                    <i class="fas fa-tint"></i>
                </div>
                <div class="detail-info">
                    <h3>Humidity</h3>
                    <p id="humidity">{{$currentWeather['main']['humidity']}}%</p>
                </div>
            </div>
            <div class="detail-card">
                <div class="detail-icon">
                    <i class="fas fa-compress-arrows-alt"></i>
                </div>
                <div class="detail-info">
                    <h3>Pressure</h3>
                    <p id="pressure"> {{$currentWeather['main']['pressure']}}hPa</p>
                </div>
            </div>
            <div class="detail-card">
                <div class="detail-icon">
                    <i class="fas fa-eye"></i>
                </div>
                <div class="detail-info">
                    <h3>Visibility</h3>
                    <p id="visibility">
                        {{$currentWeather['visibility']}}
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('script')
<script>
    $(document).ready(function(){
        $('#city-input').on('keyup', function(){
            let city = $(this).val().trim();

            if(city.length < 3) return;

            $.ajax({
                url: "{{ route('weather.search') }}",
                method: "GET",
                data: {city: city},
                success: function(data){
                    if(data && data.weather){
                        let condition = data.weather[0].main.toLowerCase();
                        const temp = Math.round(data.main.temp);
                        const humidity = data.main.humidity;
                        const pressure = data.main.pressure;
                        const wind = Math.round(data.wind.speed * 3.6);
                        const visibility = Math.round(data.visibility / 1000);
                        const cityName = data.name + ', ' + (data.sys.country === 'BD' ? 'Bangladesh' : data.sys.country);

                        $('#city-name').text(cityName);
                        $('#temperature').text(temp + '°C');
                        $('#humidity').text(humidity + '%');
                        $('#pressure').text(pressure + 'hPa');
                        $('#wind-speed').text(wind + 'km/h');
                        $('#visibility').text(visibility + 'km');

                        // Icon
                        const iconEl = $('#weather-icon');
                        $('body').removeClass('sunny cloudy rainy snowy');

                        switch (condition) {
                            case 'rain':
                                condition = 'Rainy';
                                iconEl.attr('class', 'fas fa-cloud-rain');
                                $('body').addClass('rainy');
                                break;
                            case 'clouds':
                                condition = 'Cloudy';
                                iconEl.attr('class', 'fas fa-cloud');
                                $('body').addClass('cloudy');
                                break;
                            case 'snow':
                                condition = 'Snowy';
                                iconEl.attr('class', 'fas fa-snowflake');
                                $('body').addClass('snowy');
                                break;
                            case 'clear':
                            default:
                                condition = 'Sunny';
                                iconEl.attr('class', 'fas fa-sun');
                                $('body').addClass('sunny');
                                break;
                        }
                        $('#weather-condition').text(condition);

                    }
                },
                error: function(){
                    $('#city-name').text('City not found 😔');
                    $('#temperature, #humidity, #pressure, #wind-speed, #visibility, #weather-condition').text('');
                }
            });
        });
    });
</script>

@endpush