<?php

use App\PlaceType;
use Illuminate\Database\Seeder;

class PlaceTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        PlaceType::create([
            'name' => '',
            'token' => '',
        ]);
        */

        PlaceType::create([
            'name' => 'Uczelnie',
            'token' => 'PLACE_TYPE_UNIVERSITIES',
        ]);

        PlaceType::create([
            'name' => 'Kluby',
            'token' => 'PLACE_TYPE_CLUBS',
        ]);

        PlaceType::create([
            'name' => 'Przystanki',
            'token' => 'PLACE_TYPE_BUS_STOPS',
        ]);

        PlaceType::create([
            'name' => 'Sklepy',
            'token' => 'PLACE_TYPE_MARKETS',
        ]);

        PlaceType::create([
            'name' => 'Restauracje',
            'token' => 'PLACE_TYPE_RESTAURANTS',
        ]);
    }
}
