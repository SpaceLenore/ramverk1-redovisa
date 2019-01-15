<?php
/**
 * Load the geoip as a controller class.
 */
return [
    "routes" => [
        [
            "info" => "Weather Service",
            "mount" => "weather",
            "handler" => "\Anax\WeatherController\WeatherWebController",
        ],
    ]
];
