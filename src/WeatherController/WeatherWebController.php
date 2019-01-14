<?php

namespace Anax\WeatherController;

use Anax\Commons\ContainerInjectableInterface;
use Anax\Commons\ContainerInjectableTrait;
use Anax\Common\ValidateIpAddress;

// use Anax\Route\Exception\ForbiddenException;
// use Anax\Route\Exception\NotFoundException;
// use Anax\Route\Exception\InternalErrorException;

/**
 * A sample controller to show how a controller class can be implemented.
 * The controller will be injected with $di if implementing the interface
 * ContainerInjectableInterface, like this sample class does.
 * The controller is mounted on a particular route and can then handle all
 * requests for that mount point.
 *
 * @SuppressWarnings(PHPMD.TooManyPublicMethods)
 */
class WeatherWebController implements ContainerInjectableInterface
{
    use ContainerInjectableTrait;


    /**
     * @var string $db a sample member variable that gets initialised
     */
    private $db = "not active";
    private $page;
    private $request;
    private $darksky;
    private $validator;

    /**
     * The initialize method is optional and will always be called before the
     * target method/action. This is a convienient method where you could
     * setup internal properties that are commonly used by several methods.
     *
     * @return void
     */
    public function initialize() : void
    {
        // Use to initialise member variables.
        $this->db = "active";
        $this->page = $this->di->get("page");
        $this->request = $this->di->get("request");
        $this->darksky = $this->di->get('darkSkyConnector');
        $this->ipDataTool = $this->di->get('ipStackConnector');
        $this->validator = new ValidateIpAddress();
    }



    /**
     * GET route for ip checker tool, displays a form
     *
     * @return object
     */
    public function indexAction($bvck = "", $swtc = "") : object
    {
        $title = "Weather Data";

        if ($bvck != "") {
            $usrdata = $bvck;
        } else {
            $usrdata = htmlentities($this->request->getGet('locationIndicator'));
        }

        if ($usrdata) {
            // Got data
            $location = "";
            if ($this->validator->validateIp($usrdata)) {
                //assume we got an IP
                $res = $this->ipDataTool->fetchIpData($usrdata);
                $location = $res['latitude'] . ',' . $res['longitude'];
            } else {
                //ok this is coordinates, hope for the best
                $location = $usrdata;
            }
            //fetch weather data from $location
            $weather = "";
            if ($swtc != "") {
                $timespan = $swtc;
            } else {
                $timespan = $this->request->getGet('timespan');
            }
            if ($timespan == 'month') {
                //fetch the past month of weather
                $weather = $this->darksky->quickFetchWeather($location);
                $this->page->add("weather/month", [
                    'wd' => $weather,
                ]);
            } else {
                //default to the weather for the uppcomming week
                $weather = $this->darksky->fetchWeeklyWeather($location);
                $this->page->add("weather/weekly", [
                    'wd' => $weather,
                ]);
            }

            //now render the page with title
            return $this->page->render([
                "title" => $title,
            ]);
        } else {
            // Did not get data
            $this->page->add("weather/form", []);

            return $this->page->render([
                "title" => $title,
            ]);
        }
    }

    public function apiAction() : object
    {
        $title = "Weather API Docs";

        $page = $this->di->get("page");

        $page->add("weather/api_doc", []);

        return $page->render([
            "title" => $title,
        ]);
    }
}
