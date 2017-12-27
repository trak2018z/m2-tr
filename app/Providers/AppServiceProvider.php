<?php

namespace App\Providers;

use App\Http\Controllers\Google\GoogleMapsController;
use App\Log;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;
use Schema;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->customizeSchema();
        $this->customizeValidator();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->environment() !== 'production') {
            $this->app->register(\Barryvdh\LaravelIdeHelper\IdeHelperServiceProvider::class);
        }
    }

    private function customizeSchema()
    {
        Schema::defaultStringLength(191);
    }

    private function customizeValidator()
    {
        Validator::extend('longitude', function ($attribute, $value, $parameters, $validator) {
            if (isset($validator->getData()[$parameters[0]])) {
                $lat = $validator->getData()[$parameters[0]];
            }
            if (is_null($value) || !isset($lat) || is_null($lat)) {
                return false;
            }
            $result = (new GoogleMapsController())->geocodeCoordinates($lat, $value, \GoogleMapsGeocoder::TYPE_COUNTRY);
            return $result->success && $result->response->result->results[0]->address_components[0]->short_name == "PL";
        });
    }

}