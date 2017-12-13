<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hubert Sadecki
 * Date: 2017-12-13
 * Time: 22:00
 */

namespace App\Http\Controllers\Google;


use SimpleXMLElement;

class GoogleMapsPlacesAPI
{

    /**
     * No errors occurred, the address was successfully parsed and at least one
     * geocode was returned.
     */
    const STATUS_SUCCESS = "OK";

    /**
     * Geocode was successful, but returned no results.
     */
    const STATUS_NO_RESULTS = "ZERO_RESULTS";

    /**
     * Over limit of 2,500 (100,000 if premier) requests per day.
     */
    const STATUS_OVER_LIMIT = "OVER_QUERY_LIMIT";

    /**
     * Request denied, usually because of missing key parameter.
     */
    const STATUS_REQUEST_DENIED = "REQUEST_DENIED";

    /**
     * Invalid request, usually because of missing parameter that's required.
     */
    const STATUS_INVALID_REQUEST = "INVALID_REQUEST";

    /**
     * Unnown server error. May succeed if tried again.
     */
    const STATUS_UNKNOWN_ERROR = "UNKNOWN_ERROR";

    /**
     * Domain portion of the Google Place API URL.
     */
    const URL_DOMAIN = "maps.googleapis.com";

    /**
     * Path portion of the Google Place API URL.
     */
    const URL_PATH = "/maps/api/place/";

    /**
     * HTTP URL of the Google Place API.
     */
    const URL_HTTP = "http://maps.googleapis.com/maps/api/place/";

    /**
     * HTTPS URL of the Google Place API.
     */
    const URL_HTTPS = "https://maps.googleapis.com/maps/api/place/";

    /**
     * JSON response format.
     */
    const FORMAT_JSON = "json";

    /**
     * XML response format.
     */
    const FORMAT_XML = "xml";

    /**
     * API key to authenticate with.
     *
     * @var string
     */
    private $apiKey;

    /**
     * Client ID for Business clients.
     *
     * @var string
     */
    private $clientId;

    /**
     * Cryptographic signing key for Business clients.
     *
     * @var string
     */
    private $signingKey;

    /**
     * Defines the distance (in meters) within which to return place results. The maximum allowed radius is 50 000 meters.
     *
     * @var int
     */
    private $radius;


    /**
     * Latitude to search places
     *
     * @var float|string
     */
    private $latitude;

    /**
     * Longitude to search places
     *
     * @var float|string
     */
    private $longitude;

    /**
     * Response format.
     *
     * @var string
     */
    private $format;

    /**
     * Language code in which to return results.
     *
     * @var string
     */
    private $language;

    /**
     * Page token to see more results.
     *
     * @var string
     */
    private $pagetoken;

    /**
     * Type of requested places.
     *
     * @var string
     */
    private $type;


    /**
     * GoogleMapsPlacesAPI constructor.
     * @param string $apiKey
     */
    public function __construct(string $apiKey, $format = self::FORMAT_JSON)
    {
        $this->setApiKey($apiKey)
        ->setFormat($format);
    }

    /**
     * Get the response format.
     *
     * @link   https://developers.google.com/maps/documentation/geocoding/intro#GeocodingResponses
     * @return string response format
     */
    public function getFormat() {
        return $this->format;
    }

    /**
     * Set the response format.
     *
     * @link   https://developers.google.com/maps/documentation/geocoding/intro#GeocodingResponses
     * @param  string $format response format
     * @return GoogleMapsPlacesAPI
     */
    public function setFormat($format) {
        $this->format = $format;

        return $this;
    }

    /**
     * Get the API key to authenticate with.
     *
     * @link   https://developers.google.com/console/help/new/#UsingKeys
     * @return string API key
     */
    public function getApiKey() {
        return $this->apiKey;
    }

    /**
     * Set the API key to authenticate with.
     *
     * @link   https://developers.google.com/console/help/new/#UsingKeys
     * @param  string $apiKey API key
     * @return GoogleMapsPlacesAPI
     */
    public function setApiKey($apiKey) {
        $this->apiKey = $apiKey;

        return $this;
    }

    /**
     * Set the client ID for Business clients.
     *
     * @link   https://developers.google.com/maps/documentation/business/webservices/#client_id
     * @param  string $clientId client ID
     * @return GoogleMapsPlacesAPI
     */
    public function setClientId($clientId) {
        $this->clientId = $clientId;

        return $this;
    }

    /**
     * Get the client ID for Business clients.
     *
     * @link   https://developers.google.com/maps/documentation/business/webservices/#client_id
     * @return string client ID
     */
    public function getClientId() {
        return $this->clientId;
    }

    /**
     * Set the cryptographic signing key for Business clients.
     *
     * @link   https://developers.google.com/maps/documentation/business/webservices/#cryptographic_signing_key
     * @param  string $signingKey cryptographic signing key
     * @return GoogleMapsPlacesAPI
     */
    public function setSigningKey($signingKey) {
        $this->signingKey = $signingKey;

        return $this;
    }

    /**
     * Get the cryptographic signing key for Business clients.
     *
     * @link   https://developers.google.com/maps/documentation/business/webservices/#cryptographic_signing_key
     * @return string cryptographic signing key
     */
    public function getSigningKey() {
        return $this->signingKey;
    }

    /**
     * Get the latitude/longitude to search places using coordinates.
     *
     * @link   https://developers.google.com/places/web-service/search#PlaceSearchRequests
     * @return string|false comma-separated coordinates, or false if not set
     */
    public function getLatitudeLongitude() {
        $latitude = $this->getLatitude();
        $longitude = $this->getLongitude();

        if ($latitude && $longitude) {
            return $latitude . "," . $longitude;
        }
        else {
            return false;
        }
    }

    /**
     * Set the latitude to search places.
     *
     * @link   https://developers.google.com/places/web-service/search#PlaceSearchRequests
     * @param  float|string $latitude latitude to reverse geocode
     * @return GoogleMapsPlacesAPI
     */
    public function setLatitude($latitude) {
        $this->latitude = $latitude;

        return $this;
    }

    /**
     * Get the latitude to search places.
     *
     * @link   https://developers.google.com/places/web-service/search#PlaceSearchRequests
     * @return float|string latitude to search place
     */
    public function getLatitude() {
        return $this->latitude;
    }

    /**
     * Set the longitude to search places.
     *
     * @link   https://developers.google.com/places/web-service/search#PlaceSearchRequests
     * @param  float|string $longitude longitude to search place
     * @return GoogleMapsPlacesAPI
     */
    public function setLongitude($longitude) {
        $this->longitude = $longitude;

        return $this;
    }

    /**
     * Get the longitude to reverse geocode to the closest address.
     *
     * @link   https://developers.google.com/places/web-service/search#PlaceSearchRequests
     * @return float|string longitude to reverse geocode
     */
    public function getLongitude() {
        return $this->longitude;
    }

    /**
     * Set the longitude to reverse geocode to the closest address.
     *
     * @link   https://developers.google.com/places/web-service/search#PlaceSearchRequests
     * @param  float|string $radius radius to place search
     * @return GoogleMapsPlacesAPI
     */
    public function setRadius($radius) {
        $this->radius = $radius;

        return $this;
    }

    /**
     * Get the longitude to reverse geocode to the closest address.
     *
     * @link   https://developers.google.com/places/web-service/search#PlaceSearchRequests
     * @return float|string longitude to reverse geocode
     */
    public function getRadius() {
        return $this->radius;
    }

    /**
     * Set the language code in which to return results.
     *
     * @link   https://developers.google.com/maps/faq#languagesupport
     * @param  string $language language code
     * @return GoogleMapsPlacesAPI
     */
    public function setLanguage($language) {
        $this->language = $language;

        return $this;
    }

    /**
     * Get the language code in which to return results.
     *
     * @link   https://developers.google.com/maps/faq#languagesupport
     * @return string language code
     */
    public function getLanguage() {
        return $this->language;
    }

    /**
     * Set the page token to get more results.
     *
     * @link   https://developers.google.com/places/web-service/search#PlaceSearchPaging
     * @param  string $pagetoken pagetoken
     * @return GoogleMapsPlacesAPI
     */
    public function setPagetoken($pagetoken) {
        $this->pagetoken = $pagetoken;

        return $this;
    }

    /**
     * Get the pagetoken
     *
     * @link   https://developers.google.com/places/web-service/search#PlaceSearchPaging
     * @return string pagetoken
     */
    public function getPagetoken() {
        return $this->pagetoken;
    }

    /**
     * Set the type for requested places
     *
     * @Link https://developers.google.com/places/web-service/supported_types
     * @param $type place type
     * @return GoogleMapsPlacesAPI
     */
    public function setType($type){
        $this->type = $type;

        return $this;
    }

    /**
     * Get the type
     *
     * @link   https://developers.google.com/places/web-service/supported_types
     * @return string type
     */
    public function getType() {
        return $this->type;
    }

    /**
     * Whether the request is for a Business client.
     *
     * @return bool whether the request is for a Business client
     */
    public function isBusinessClient() {
        return $this->getClientId() && $this->getSigningKey();
    }

    /**
     * Whether the response format is JSON.
     *
     * @link   https://developers.google.com/places/web-service/search#PlaceSearchResponses
     * @return bool whether JSON
     */
    public function isFormatJson() {
        return $this->getFormat() == self::FORMAT_JSON;
    }

    /**
     * Whether the response format is XML.
     *
     * @link   https://developers.google.com/places/web-service/search#PlaceSearchResponses
     * @return bool whether XML
     */
    public function isFormatXml() {
        return $this->getFormat() == self::FORMAT_XML;
    }

    /**
     * Generate the signature for a Business client geocode request.
     *
     * @link   https://developers.google.com/maps/documentation/business/webservices/auth#digital_signatures
     * @param  string $pathQueryString path and query string of the request
     * @return string Base64 encoded signature that's URL safe
     */
    private function generateSignature($pathQueryString) {
        $decodedSigningKey = self::base64DecodeUrlSafe($this->getSigningKey());

        $signature = hash_hmac('sha1', $pathQueryString, $decodedSigningKey, true);
        $signature = self::base64EncodeUrlSafe($signature);

        return $signature;
    }

    /**
     * Build the query string with all set parameters of the geocode request.
     * TODO
     * @link   https://developers.google.com/places/web-service/search#PlaceSearchRequests
     * @return string encoded query string of the geocode request
     */
    private function searchQueryString() {
        $queryString = array();

        // One of the following is required.

        $queryString['location'] =  $this->getLatitudeLongitude();

        // Optional parameters.
        $queryString['language'] = $this->getLanguage();
        $queryString['type'] = $this->getType();

        $pagetoken = $this->getPagetoken();
        if($pagetoken){
            $queryString["pagetoken"] = $pagetoken;
        }

        // Remove any unset parameters.
        $queryString = array_filter($queryString);

        // The signature is added later using the path + query string.
        if ($this->isBusinessClient()) {
            $queryString['client'] = $this->getClientId();
        }
        elseif ($this->getApiKey()) {
            $queryString['key'] = $this->getApiKey();
        }

        // Convert array to proper query string.
        return http_build_query($queryString);
    }

    /**
     * Build the URL (with query string) of the geocode request.
     *
     * @link   https://developers.google.com/places/web-service/search#PlaceSearchRequests
     * @param  bool $https whether to make the request over HTTPS
     * @return string URL of the geocode request
     */
    private function searchUrl($https = false) {
        // HTTPS is required if an API key is set.
        if ($https || $this->getApiKey()) {
            $scheme = "https";
        }
        else {
            $scheme = "http";
        }

        $pathQueryString = self::URL_PATH . 'nearbysearch/' . $this->getFormat() . "?" . $this->geocodeQueryString();

        if ($this->isBusinessClient()) {
            $pathQueryString .= "&signature=" . $this->generateSignature($pathQueryString);
        }

        return $scheme . "://" . self::URL_DOMAIN . $pathQueryString;
    }

    /**
     * Execute the geocoding request. The return type is based on the requested
     * format: associative array if JSON, SimpleXMLElement object if XML.
     *
     * @link   https://developers.google.com/maps/documentation/geocoding/intro#GeocodingResponses
     * @param  bool $https whether to make the request over HTTPS
     * @param  bool $raw whether to return the raw (string) response
     * @param  resource $context stream context from `stream_context_create()`
     * @return string|array|SimpleXMLElement response in requested format
     */
    public function search($https = false, $raw = false, $context = null) {
        $response = file_get_contents($this->searchUrl($https), false, $context);

        if ($raw) {
            return $response;
        }
        elseif ($this->isFormatJson()) {
            return json_decode($response, true);
        }
        elseif ($this->isFormatXml()) {
            return new SimpleXMLElement($response);
        }
        else {
            return $response;
        }
    }



    /**
     * Encode a string with Base64 using only URL safe characters.
     *
     * @param  string $value value to encode
     * @return string encoded value
     */
    private static function base64EncodeUrlSafe($value) {
        return strtr(base64_encode($value), '+/', '-_');
    }

    /**
     * Decode a Base64 string that uses only URL safe characters.
     *
     * @param  string $value value to decode
     * @return string decoded value
     */
    private static function base64DecodeUrlSafe($value) {
        return base64_decode(strtr($value, '-_', '+/'));
    }
}