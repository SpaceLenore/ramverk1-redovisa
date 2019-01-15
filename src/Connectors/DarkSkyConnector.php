<?php

namespace Anax\Connectors;

use Anax\Common\CurlHandler;
use Anax\Config\ApiTokens;

/**
* Connector class for the ipstack api
*/
class DarkSkyConnector
{

    private $keys;

    public function setKeys($keyData)
    {
        $this->keys = $keyData;
    }

    /**
    * Fetching the api data for the specified ip
    * @param ip the ip address to be checked
    * @param configPath path for the config that's loaded
    */
    public function fetchWeeklyWeather($longlat)
    {
        $curl = new CurlHandler();
        //Load key from configuration
        $accessKey = $this->keys['darksky'];
        $address = 'https://api.darksky.net/forecast/' . $accessKey . '/' . $longlat . '?units=si&language=sv&exclude=currently,minutely,hourly,alerts';
        $jsonResponse = $curl->jsonCurl($address);
        return $jsonResponse;
    }

    // public function fetchPastMonthWeather($longlat)
    // {
    //     $curl = new CurlHandler();
    //     //Load key from configuration
    //     $accessKey = $this->keys['darksky'];
    //
    //     $urls = [
    //         'https://api.darksky.net/forecast/' . $accessKey . '/' . $longlat . ',' . date('U', strtotime('-8 days')) . '?units=si&language=sv&exclude=currently,minutely,hourly,alerts',
    //         'https://api.darksky.net/forecast/' . $accessKey . '/' . $longlat . ',' . date('U', strtotime('-16 days')) . '?units=si&language=sv&exclude=currently,minutely,hourly,alerts',
    //         'https://api.darksky.net/forecast/' . $accessKey . '/' . $longlat . ',' . date('U', strtotime('-24 days')) . '?units=si&language=sv&exclude=currently,minutely,hourly,alerts',
    //         'https://api.darksky.net/forecast/' . $accessKey . '/' . $longlat . ',' . date('U', strtotime('-32 days')) . '?units=si&language=sv&exclude=currently,minutely,hourly,alerts',
    //     ];
    //
    //     $weatherData = $curl->multiCurl($urls);
    //
    //     return $weatherData;
    // }

    public function quickFetchWeather($longlat)
    {
        $curl = new CurlHandler();
        //Load key from configuration
        $accessKey = $this->keys['darksky'];

        $urls = [];

        for ($i=1; $i <= 30; $i++) {
            array_push($urls, 'https://api.darksky.net/forecast/' . $accessKey . '/' . $longlat . ',' . date('U', strtotime('-' . $i . ' days')) . '?units=si&language=sv&exclude=currently,minutely,hourly,alerts');
        }


        $weatherData = $curl->quickCurl($urls);

        return $weatherData;
    }
}
