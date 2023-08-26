<?php

namespace Handlers;
use Entities\City;
use Entities\Coordinate;

class CityListHandler
{
    private string $filePath;
    private WeatherRequestHandler $weatherHandler;
    public function __construct(string $filePath) {
        $this->filePath = $_SERVER['DOCUMENT_ROOT'] . $filePath;
        $this->weatherHandler = new WeatherRequestHandler($_ENV['API_KEY']);
    }
    public function processFile()
    {
        $handle = fopen($this->filePath, "r");

        $cities = [];
        if ($handle) {
            $labels = fgets($handle);
            if ($labels !== false) {
                $labels = explode(' ', trim($labels));
            }
            while (($line = fgets($handle)) !== false) {
                $lineArr = $this->parseLine($line, $labels);
                $city = new City();
                $city->name = $lineArr['name'];
                $city->coordinate = new Coordinate();
                $city->coordinate->latitude = (float)$lineArr['latitude'];
                $city->coordinate->longitude = (float)$lineArr['longitude'];
                $this->proccessCity($city);
                $cities[] = $city;
            }
            fclose($handle);
        }
        $this->sortByTempGap($cities);
        return $cities;
    }
    public function proccessCity(\Entities\City &$city)
    {
        $weather = $this->weatherHandler->getWeather($city->coordinate->longitude, $city->coordinate->latitude);
        if (!empty($weather)) {
            $city->maxTemp = $weather['main']['temp_max'];
            $city->minTemp = $weather['main']['temp_min'];
            $weatherCur = current($weather['weather']);
            $city->weatherDescription = $weatherCur['description'];
            $city->icon = "https://openweathermap.org/img/wn/{$weatherCur['icon']}@2x.png";
        }
    }

    public function sortByTempGap(&$cityList)
    {

        usort($cityList, function (City $city1, City $city2) {
            $city1gap = $city1->maxTemp - $city1->minTemp;
            $city2gap = $city2->maxTemp - $city2->minTemp;
            if ($city1gap == $city2gap) {
                return 0;
            }
            return ($city1gap < $city2gap) ? -1 : 1;
        });
    }

    private function parseLine(string $line, array $labels)
    {
        $nameInd = array_search('city', $labels);
        $latInd = array_search('latitude', $labels);
        $lonInd = array_search('longitude', $labels);

        $lineArr = [];
        if (preg_match_all('/"([^"]*)"/', $line, $matches)) {
            $name =  $matches[0][0];
            $line = str_replace($name, '', $line);
            $lineArr['name'] = str_replace('"', '', $name);
        }

        $line = explode(' ', $line);
        $lineArr['latitude'] = $line[$latInd];
        $lineArr['longitude'] = $line[$lonInd];
        if (!isset($lineArr['name'])) {
            $lineArr['name'] = $line[$nameInd];
        }
        return $lineArr;
    }
}
