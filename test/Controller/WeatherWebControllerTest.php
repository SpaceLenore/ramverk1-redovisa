<?php

namespace Anax\WeatherController;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class WeatherWebControllerTest extends TestCase
{

    /**
     * Prepare before each test.
     */
    protected function setUp()
    {
        global $di;

        // Setup di
        $this->di = new DIFactoryConfig();
        $this->di->loadServices(ANAX_INSTALL_PATH . "/config/di");

        // View helpers uses the global $di so it needs its value
        $di = $this->di;

        // Setup the controller
        $this->controller = new WeatherWebController();
        $this->controller->setDI($this->di);
        $this->controller->initialize();
    }

    public function testIndexActionGet()
    {
        $res = $this->controller->indexAction();
        $body = $res->getBody();
        $this->assertContains("Hämta Väderdata", $body);
    }

    public function testIndexActionWithIp()
    {
        $res = $this->controller->indexAction('1.1.1.1');
        $body = $res->getBody();
        $this->assertContains("Veckans Väder", $body);
    }

    public function testIndexActionWithCoords()
    {
        $res = $this->controller->indexAction('56.1616,15.5866');
        $body = $res->getBody();
        $this->assertContains("Veckans Väder", $body);
    }

    public function testIndexActionPastWeatherWithCoords()
    {
        $res = $this->controller->indexAction('56.1616,15.5866', 'month');
        $body = $res->getBody();
        $this->assertContains("Vädret för de 30 senaste dagarna", $body);
    }

    public function testApiDoc()
    {
        $res = $this->controller->apiAction();
        $body = $res->getBody();
        $this->assertContains("Weather API", $body);
    }
}
