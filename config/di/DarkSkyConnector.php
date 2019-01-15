<?php
/**
 * Configuration file for DI container.
 */
return [

    // Services to add to the container.
    "services" => [
        "darkSkyConnector" => [
            "shared" => true,
            "callback" => function () {
                $dskycon = new \Anax\Connectors\DarkSkyConnector();
                // Load the configuration files
                $cfg = $this->get("configuration");
                $config = $cfg->load("ApiTokens.php");
                $dskycon->setKeys($config['config']);

                return $dskycon;
            }
        ],
    ],
];
