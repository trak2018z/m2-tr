<?php

namespace Tests\Unit;

use App\Http\Controllers\Google\GoogleMapsController;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GoogleServiceTest extends TestCase
{

    /**
     * @var GoogleMapsController
     */
    private $api;

    private $result;

    /**
     * GoogleServiceTest constructor.
     */
    public function setUp()
    {
        $this->api = new GoogleMapsController();
    }


    /**
     * A basic test example.
     *
     * @return void
     */
    public function testGeocodeCoordinates()
    {
        $this->result = $this->api->geocodeCoordinates(50.01623, 22.67776);
        $this->assertTrue($this->result->success);
        $this->displayResult();
    }

    public function testGeocodeAddress(){
        $this->result = $this->api->geocodeAddress("Rzeszów Wincentego Pola 2");
        $this->assertTrue($this->result->success);
        $this->displayResult();
    }

    public function testPlacesCoordinates(){
        $this->result = $this->api->placeSearch(50.01623, 22.67776);
        $this->assertTrue($this->result->success);
        $this->displayResult();
    }

    public function testPlacesQuery(){
        $this->result = $this->api->placeSearchQuery("Rzeszów");
        $this->assertTrue($this->result->success);
        $this->displayResult();
    }

    private function displayResult($additional = null)
    {
        if (!is_null($additional)) {
            echo $additional . "\r\n";
        }
        echo json_encode($this->result) . "\r\n";
    }

}
