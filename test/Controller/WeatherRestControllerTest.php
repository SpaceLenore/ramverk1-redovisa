<?php

namespace Anax\WeatherController;

use Anax\DI\DIFactoryConfig;
use PHPUnit\Framework\TestCase;

/**
 * Test the SampleController.
 */
class WeatherRestControllerTest extends TestCase
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
        $this->controller = new WeatherRestController();
        $this->controller->setDI($this->di);
        $this->controller->initialize();
    }

    public function testIndexActionGet()
    {
        $res = $this->controller->indexAction();
        $this->assertContains("No data provided", $res[0]['error']);
    }

    public function testIndexActionWithIp()
    {
        $res = $this->controller->indexAction('1.1.1.1');
        $this->assertContains("Australia/Sydney", $res[0]['weather']['timezone']);
    }

    public function testIndexActionWithCoords()
    {
        $res = $this->controller->indexAction('56.1616,15.5866');
        $this->assertContains('56.1616,15.5866', $res[0]['location']);
    }

    public function testIndexActionPastWeatherWithCoords()
    {
        $res = $this->controller->indexAction('56.1616,15.5866', 'month');
        $this->assertContains('56.1616,15.5866', $res[0]['location']);
    }
}
