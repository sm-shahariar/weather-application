🌤️ WeatherCast

Real-time weather updates and 5-day forecast at your fingertips.

Requirements

PHP 8.2 or higher

Composer

Node.js & NPM (optional for asset compilation)

Quick Start
1. Clone the repository
git clone https://github.com/yourusername/weathercast.git
cd weathercast

2. Install dependencies
composer install
npm install

3. Environment setup
cp .env.example .env
php artisan key:generate

4. Configure your OpenWeather API key in .env
OPENWEATHER_KEY=your_api_key_here

5. Run migrations (optional, if storing user searches)
php artisan migrate

6. Build assets
npm run dev

7. Start the development server
php artisan serve

8. Open in Browser

http://127.0.0.1:8000

About

WeatherCast is a dynamic weather application built with Laravel, Blade, and jQuery. It allows users to:

Search for any city and get live weather updates.

View current weather, temperature, humidity, wind speed, and visibility.

See a 5-day forecast in an expandable section.

Enjoy dynamic backgrounds and weather icons based on conditions.

Resources

Readme

OpenWeather API

Contributors

@sm-shahariar – SM Shahariar Rahman
