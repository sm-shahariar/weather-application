document.addEventListener('DOMContentLoaded', function() {

    const weatherEl = document.getElementById('weather-data');

    // Parse JSON data from the data-* attributes
    const currentWeather = JSON.parse(weatherEl.dataset.current || '{}');
    const dailyForecasts = JSON.parse(weatherEl.dataset.forecast || '[]');

    console.log(currentWeather, dailyForecasts);

    if (currentWeather && Object.keys(currentWeather).length > 0) {
        const tempC = Math.round(currentWeather.main.temp);
        document.getElementById('temperature').textContent = tempC + '°C';

        const wind_speed = Math.round(currentWeather.wind.speed * 3.6);
        document.getElementById('wind-speed').textContent = wind_speed + ' km/h';

        const visibility = Math.round(currentWeather.visibility / 1000);
        document.getElementById('visibility').textContent = visibility + ' km';

        let condition = currentWeather.weather[0].main.toLowerCase();
        const iconEl = document.getElementById('weather-icon');

        document.body.className = '';

        switch (condition) {
            case 'rain':
                iconEl.className = 'fas fa-cloud-rain';
                condition = 'Rainy';
                document.body.classList.add('rainy');
                break;
            case 'clouds':
                iconEl.className = 'fas fa-cloud';
                condition = 'Cloudy';
                document.body.classList.add('cloudy');
                break;
            case 'snow':
                iconEl.className = 'fas fa-snowflake';
                condition = 'Snowy';
                document.body.classList.add('snowy');
                break;
            case 'clear':
            default:
                iconEl.className = 'fas fa-sun';
                condition = 'Sunny';
                document.body.classList.add('sunny');
                break;
        }

        document.getElementById('weather-condition').textContent = condition;
    }


    // Forecast toggle
    const forecastToggle = document.getElementById('forecast-toggle');
    const forecastContainer = document.getElementById('forecast-container');
    const toggleArrow = document.getElementById('toggle-arrow');

    forecastToggle.addEventListener('click', function() {
        forecastContainer.classList.toggle('active');
        toggleArrow.classList.toggle('fa-chevron-down');
        toggleArrow.classList.toggle('fa-chevron-up');
    });

    // Populate 5-day forecast
    if (dailyForecasts && dailyForecasts.length) {
        dailyForecasts.forEach(day => {
            const forecastDay = document.createElement('div');
            forecastDay.className = 'forecast-day';

            let iconClass;
            switch (day.condition.toLowerCase()) {
                case 'rain':
                    iconClass = 'fas fa-cloud-rain';
                    break;
                case 'clouds':
                    iconClass = 'fas fa-cloud';
                    break;
                case 'snow':
                    iconClass = 'fas fa-snowflake';
                    break;
                case 'clear':
                default:
                    iconClass = 'fas fa-sun';
                    break;
            }

            forecastDay.innerHTML = `
                <div class="forecast-date">${day.date}</div>
                <div class="forecast-icon"><i class="${iconClass}"></i></div>
                <div class="forecast-temp">${day.temp}°C</div>
                <div class="forecast-condition">${day.condition}</div>
            `;
            forecastContainer.appendChild(forecastDay);
        });
    }

    // Search
    const searchBtn = document.getElementById('search-btn');
    const cityInput = document.getElementById('city-input');

    searchBtn.addEventListener('click', function() {
        const city = cityInput.value.trim();
        if (city) {
            window.location.href = `?city=${encodeURIComponent(city)}`;
        }
    });
});