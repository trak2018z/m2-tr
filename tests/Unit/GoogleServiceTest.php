<?php

namespace Tests\Unit;

use App\Http\Controllers\Google\GoogleLocationType;
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
        $this->result = $this->api->geocodeCoordinates(50.05669793151598, 22.49622344970703, \GoogleMapsGeocoder::TYPE_STREET_ADDRESS);
        $this->displayResult();
        $this->assertTrue($this->result->success);
    }

    public function testGeocodeAddress(){
        $this->result = $this->api->geocodeAddress("Rzeszów Wincentego Pola 2");
        $this->assertTrue($this->result->success);
        $this->displayResult();
    }

    public function testPlacesCoordinates(){
        $this->result = $this->api->placeSearch(50.01623, 22.67776, GoogleLocationType::TYPE_SUPERMARKET, 30000);
        $this->assertTrue($this->result->success);
        $this->displayResult();
    }

    public function testPlacesCoordinatesNext(){
        $this->result = $this->api->placeSearchNext("CqQCEwEAAC7tE_366r0cgdjegDYv7IEx3cS_JeaqXkNaNxneO4Iw5aBbeCYWormOhuCTKSvPnpyIWCNTekHX32Fog7kaUHRJ8dyO_MjQt7MYxKo_7jJJW0t71GRpzN64VtaKzuijPs_woLTpwXF65T4-7vap9pjIdrfx_urcRHX5Zk50oFK1ZIwimoyaZHrVrO5EdIw-MptAOFGv2NSF-Jwyn05ZJZ2r0Us448pnUTKKy3tl8v7_kSKp7vBug74f0ZB-lLNSmcdLE4xZZzUzsFt8cdyV6gqx5oZP-2XYG572jHrU5rJdXcKgQ9DD21_kmAUJ9MvxlITJfSFb8Cyz56tqlCLnQUXTzgZVrcCLnDS4x1KrcZ35S93Qsd6THQDovWpaTbbbsxIQ6Brg1Z-h4rVLWtuyCGyAGhoUzMYtI8nbzBaDFjk5sYC9fLiuwJU");
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
