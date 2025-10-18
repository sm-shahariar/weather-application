WeatherCast 🌤️

WeatherCast is a dynamic web application that allows users to check real-time weather information for any city. Built with Laravel and jQuery, it features an interactive UI, live updates, and a 5-day forecast display. The app fetches weather data from the OpenWeather API and presents it in a user-friendly format.

Key Features

City Weather Search – Search any city and get instant weather updates as you type.

Current Weather Display – Shows temperature, weather condition, and corresponding icon.

Date and Time Display – Current date in a readable format (Day, DD MMM YYYY).

Detailed Weather Info – Wind speed, humidity, pressure, and visibility.

Dynamic Background – Changes page background based on weather (Sunny, Rainy, Cloudy, Snowy).

5-Day Forecast – Expandable section showing the next five days’ weather.

Responsive UI – Works smoothly on desktop and mobile devices.

AJAX-Based Updates – Live updates without page refresh.

Error Handling – Alerts users if the city is not found.

How to Use

Clone the Repository

git clone https://github.com/yourusername/weathercast.git
cd weathercast


Install Dependencies

composer install
npm install
npm run dev


Set Up Environment

Copy .env.example to .env

Add your OpenWeather API key:

OPENWEATHER_KEY=your_api_key_here


Run Migrations (if needed)

php artisan migrate


Run the Project

php artisan serve


Access in Browser

Open http://127.0.0.1:8000
 and start searching for any city!

How Others Can Use It

Anyone with PHP, Laravel, and Node.js installed can clone the project and run it locally.

You just need an OpenWeather API key (free signup on OpenWeather
) to fetch live weather data.

No database setup is required unless you plan to extend it for storing user searches.

Tech Stack

Backend: Laravel 10

Frontend: Blade, jQuery, Font Awesome

API: OpenWeather API

Styling: CSS3
