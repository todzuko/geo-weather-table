<?php
namespace Handlers;

class WeatherRequestHandler
{
    private string $sApiUrl = 'https://api.openweathermap.org/data/2.5/weather';
    private string $sApiKey;


    public function __construct(string $sApiKey)
    {
        $this->sApiKey = $sApiKey;
    }

   public function getWeather($lon, $lat) {
        $url =  $this->sApiUrl . "?lat={$lat}&lon={$lon}&appid={$this->sApiKey}";
        return $this->executeGetRequest($url);
   }

    private function executeGetRequest(string $sUrl): array
    {
        $oCurlHandle = curl_init();
        curl_setopt($oCurlHandle, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($oCurlHandle, CURLOPT_URL, $sUrl);

        $sResult = curl_exec($oCurlHandle);
        $aInfo = curl_getinfo($oCurlHandle);
        if ($aInfo['http_code'] != 200) {
            return [];
        }
        curl_close($oCurlHandle);
        return json_decode($sResult, true);
    }
}
