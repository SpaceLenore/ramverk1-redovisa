<?php
/**
 * Load the geoip as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Weather API Service",
            "mount" => "weather-api",
            "handler" => "\Anax\WeatherController\WeatherRestController",
        ],
    ]
];
