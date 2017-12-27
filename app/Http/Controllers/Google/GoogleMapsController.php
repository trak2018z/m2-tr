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
     * @var \GoogleMapsGeocoder
     */
    private $geocode;

    private $place;

    /**
     * GoogleMapsController constructor.
     */
    function __construct()
    {
        $key = env('GOOGLE_API_KEY','AIzaSyCxEk1ufGzA-5h8YkAXVK2nxfCb5YMiX6Y');
        $this->geocode = new \GoogleMapsGeocoder();
        $this->geocode->setLanguage("pl")->setApiKey($key);

        $this->place = new GoogleMapsPlacesAPI();
        $this->place->setLanguage("pl")->setApiKey($key);
    }

    public function doGeocodeRequest(){
        $result = $this->geocode->geocode();
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
                    $message = "Zapytanie odrzucone, prawdopodobnie brakuje klucza API.";
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

    public function geocodeCoordinates($latitude, $longitude, $type = null){
        $this->geocode->setLatitude($latitude);
        $this->geocode->setLongitude($longitude);
        if(!is_null($type)){
            $this->geocode->setResultType($type);
        }
        return $this->doGeocodeRequest();
    }

    public function geocodeAddress($address){
        $this->geocode->setAddress($address);
        return $this->doGeocodeRequest();
    }

    public function wrapGooglePlaceApiResponse($result){
        if($result["status"] == GoogleMapsPlacesAPI::STATUS_SUCCESS){
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
                case GoogleMapsPlacesAPI::STATUS_INVALID_REQUEST:
                    $message = "Niepoprawne zapytanie.";
                    $code = 400;
                    break;
                case GoogleMapsPlacesAPI::STATUS_REQUEST_DENIED:
                    $message = "Zapytanie odrzucone, prawdopodobnie brakuje klucza API.";
                    $code = 403;
                    break;
                case GoogleMapsPlacesAPI::STATUS_OVER_LIMIT:
                    $message = "Limit zapytań został przekroczony.";
                    $code = 403;
                    break;
                case GoogleMapsPlacesAPI::STATUS_NO_RESULTS:
                    $message = "Nie znaleziono pasujących wyników.";
                    $code = 404;
                    break;
                case GoogleMapsPlacesAPI::STATUS_UNKNOWN_ERROR:
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

    public function placeSearch($latitude, $longitude, $type = null, $radius = 50000){
        $this->place->setLatitude($latitude)->setLongitude($longitude)->setRadius($radius)->setQuery(null)->setType($type);
        return $this->wrapGooglePlaceApiResponse($this->place->searchNearby());
    }

    public function placeSearchQuery($query, $type = null, $radius = 50000){
        $this->place->setLatitude(null)->setLongitude(null)->setRadius($radius)->setQuery($query)->setType($type);
        return $this->wrapGooglePlaceApiResponse($this->place->searchText());
    }

}