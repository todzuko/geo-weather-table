# geo-weather-table

1. Copy the file .env.dist and rename it to .env
2. Run make up
3. Open http://localhost:62000/

The file /data/cities.dat contains a list of cities with zip code, name and geo coordinates. Read this file with PHP.

Use the weather API to get the current weather data for these cities: https://openweathermap.org/current



Sign up for free and use your own API key. If that fails, you can use 5022b9a87ad270482de49a4444437369

Create a small website where you can enter your position as longitude + latitude in two form fields and then show a table with the cities from the file attached.

The table should be ordered by temperature spread (difference between min and max temperature), with the city with the smallest temperature spread at the top.



The table should contain:

- City name

- Min temperature

- Max temperature

- Distance to the entered coordinates

- Weather description (including icon) of weather conditions from API