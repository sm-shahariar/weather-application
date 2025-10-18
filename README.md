🌤️ WeatherCast

WeatherCast is a modern web weather application that lets users check real-time weather conditions and a 5-day forecast for any city. Built with Laravel, Blade, and jQuery, it provides an interactive, dynamic, and responsive UI.

🔹 Key Features

City Weather Search: Type any city and get live weather updates instantly.

Current Weather Display: Shows temperature, weather condition, and icon.

Date & Time Display: Readable format (Day, DD MMM YYYY).

Detailed Weather Info: Wind speed, humidity, pressure, visibility.

Dynamic Background: Background changes based on weather (Sunny, Rainy, Cloudy, Snowy).

5-Day Forecast: Expandable section showing the next 5 days.

Responsive & Interactive UI: Works seamlessly on desktop and mobile.

AJAX-Based Updates: No page refresh needed.

Error Handling: Alerts when the city is not found.

💻 Technology Stack

Backend: Laravel 10

Frontend: Blade, jQuery

API: OpenWeather API

Styling: CSS3, Font Awesome

🚀 Installation & Usage

Clone the repository: git clone https://github.com/yourusername/weathercast.git

Enter Proejct: cd weathercast

Install dependencies:

composer install

npm install

npm run dev

Set up .env file:

cp .env.example .env

php artisan key:generate

Add your OpenWeather API key:

OPENWEATHER_KEY=your_api_key_here

Run the server: php artisan serve

Access in Browser: http://127.0.0.1:8000

🌟 How Others Can Use It

Clone the repo and run locally with PHP, Laravel, and Node.js installed.

Get your free OpenWeather API key to fetch live data.

No database setup is needed unless extended for user history.
