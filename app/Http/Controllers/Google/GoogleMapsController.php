<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hubert Sadecki
 * Date: 2017-12-13
 * Time: 21:03
 */

namespace App\Http\Controllers\Google;


class GoogleMapsController
{

    /**
     * @var
     */
    private $api;

    private $service;

    /**
     * GoogleMapsController constructor.
     */
    function __construct()
    {
        $this->api = new \GoogleMapsGeocoder();
        $this->api->setLanguage("pl");
        $this->api->setApiKey(env('GOOGLE_API_KEY'));
    }

    public function doRequest(){
        $result = $this->api->geocode();
        if($result["status"] == \GoogleMapsGeocoder::STATUS_SUCCESS){
            return json_decode(json_encode([
                "success" => true,
                "response" => [
                    "result" => $result,
                    "message" => "OK",
                ]
            ]));
        } else {
            $message = "Wystąpił nieoczekiwany błąd.";
            $code = 500;
            switch ($result["status"]){
                case \GoogleMapsGeocoder::STATUS_INVALID_REQUEST:
                    $message = "Niepoprawne zapytanie.";
                    $code = 400;
                    break;
                case \GoogleMapsGeocoder::STATUS_REQUEST_DENIED:
                    $message = "Zapytanie odrzucone.";
                    $code = 403;
                    break;
                case \GoogleMapsGeocoder::STATUS_OVER_LIMIT:
                    $message = "Limit zapytań został przekroczony.";
                    $code = 403;
                    break;
                case \GoogleMapsGeocoder::STATUS_NO_RESULTS:
                    $message = "Nie znaleziono pasujących wyników.";
                    $code = 404;
                    break;
                case \GoogleMapsGeocoder::STATUS_UNKNOWN_ERROR:
                    break;
            }
            return json_decode(json_encode([
                "success" => false,
                "response" => [
                    "result" => $result,
                    "message" => $message,
                ],
                "code" => $code,
            ]));
        }
    }

    public function geocodeCoordinates($latitude, $longitude){
        $this->api->setLatitude($latitude);
        $this->api->setLongitude($longitude);
        return $this->doRequest();
    }

    public function geocodeAddress($address){
        $this->api->setAddress($address);
        return $this->doRequest();
    }

}