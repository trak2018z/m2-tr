<?php
/**
 * Created by IntelliJ IDEA.
 * User: Hubert Sadecki
 * Date: 2017-12-13
 * Time: 23:11
 */

namespace App\Http\Controllers\Google;


class GoogleLocationType
{
    const TYPE_ACCOUNTING = 'accounting';
    const TYPE_AIRPORT = 'airport';
    const TYPE_AMUSEMENT_PARK = 'amusement_park';
    const TYPE_AQUARIUM = 'aquarium';
    const TYPE_ATM = 'atm';
    const TYPE_BAKERY = 'bakery';
    const TYPE_BANK = 'bank';
    const TYPE_BAR = 'bar';
    const TYPE_BEAUTY_SALON = 'beauty_salon';
    const TYPE_BOOK_STORE = 'book_store';
    const TYPE_BOWLING_ALLEY = 'bowling_alley';
    const TYPE_BUS_STATION = 'bus_station';
    const TYPE_CAFE = 'cafe';
    const TYPE_CAMPGROUND = 'campground';
    const TYPE_CAR_DEALER = 'car_dealer';
    const TYPE_CAR_RENTAL = 'car_rental';
    const TYPE_CAR_REPAIR = 'car_repair';
    const TYPE_CAR_WASH = 'car_wash';
    const TYPE_CASINO = 'casino';
    const TYPE_CEMETERY = 'cemetery';
    const TYPE_CHURCH = 'church';
    const TYPE_CITY_HALL = 'city_hall';
    const TYPE_CONVENIENCE_STORE = 'convenience_store';
    const TYPE_COURTHOUSE = 'courthouse';
    const TYPE_DENTIST = 'dentist';
    const TYPE_DEPARTMENT_STORE = 'department_store';
    const TYPE_DOCTOR = 'doctor';
    const TYPE_ELECTRICIAN = 'electrician';
    const TYPE_ELECTRONICS_STORE = 'electronics_store';
    const TYPE_EMBASSY = 'embassy';
    const TYPE_FIRE_STATION = 'fire_station';
    const TYPE_FLORIST = 'florist';
    const TYPE_FUNERAL_HOME = 'funeral_home';
    const TYPE_FURNITURE_STORE = 'furniture_store';
    const TYPE_GAS_STATION = 'gas_station';
    const TYPE_GYM = 'gym';
    const TYPE_HAIR_CARE = 'hair_care';
    const TYPE_HINDU_TEMPLE = 'hindu_temple';
    const TYPE_HOME_GOODS_STORE = 'home_goods_store';
    const TYPE_HOSPITAL = 'hospital';
    const TYPE_INSURANCE_AGENCY = 'insurance_agency';
    const TYPE_JEWELRY_STORE = 'jewelry_store';
    const TYPE_LAUNDRY = 'laundry';
    const TYPE_LAWYER = 'lawyer';
    const TYPE_LIQUOR_STORE = 'liquor_store';
    const TYPE_LOCAL_GOVERNMENT_OFFICE = 'local_government_office';
    const TYPE_LOCKSMITH = 'locksmith';
    const TYPE_LODGING = 'lodging';
    const TYPE_MEAL_DELIVERY = 'meal_delivery';
    const TYPE_MEAL_TAKEAWAY = 'meal_takeaway';
    const TYPE_MOSQUE = 'mosque';
    const TYPE_MOVIE_RENTAL = 'movie_rental';
    const TYPE_MOVIE_THEATER = 'movie_theater';
    const TYPE_MOVING_COMPANY = 'moving_company';
    const TYPE_MUSEUM = 'museum';
    const TYPE_NIGHT_CLUB = 'night_club';
    const TYPE_PAINTER = 'painter';
    const TYPE_PARK = 'park';
    const TYPE_PARKING = 'parking';
    const TYPE_PET_STORE = 'pet_store';
    const TYPE_PHARMACY = 'pharmacy';
    const TYPE_PHYSIOTHERAPIST = 'physiotherapist';
    const TYPE_PLUMBER = 'plumber';
    const TYPE_POLICE = 'police';
    const TYPE_POST_OFFICE = 'post_office';
    const TYPE_REAL_ESTATE_AGENCY = 'real_estate_agency';
    const TYPE_RESTAURANT = 'restaurant';
    const TYPE_ROOFING_CONTRACTOR = 'roofing_contractor';
    const TYPE_RV_PARK = 'rv_park';
    const TYPE_SCHOOL = 'school';
    const TYPE_SHOPPING_MALL = 'shopping_mall';
    const TYPE_SPA = 'spa';
    const TYPE_STADIUM = 'stadium';
    const TYPE_STORAGE = 'storage';
    const TYPE_STORE = 'store';
    const TYPE_SUBWAY_STATION = 'subway_station';
    const TYPE_SUPERMARKET = 'supermarket';
    const TYPE_SYNAGOGUE = 'synagogue';
    const TYPE_TAXI_STAND = 'taxi_stand';
    const TYPE_TRAIN_STATION = 'train_station';
    const TYPE_TRANSIT_STATION = 'transit_station';
    const TYPE_TRAVEL_AGENCY = 'travel_agency';
    const TYPE_UNIVERSITY = 'university';
    const TYPE_VETERINARY_CARE = 'veterinary_care';
    const TYPE_ZOO = 'zoo';

    public static function get($type){
        return constant('self::'.$type);
    }
}