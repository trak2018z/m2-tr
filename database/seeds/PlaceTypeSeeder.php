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
            'token' => 'TYPE_UNIVERSITY',
        ]);

        PlaceType::create([
            'name' => 'Kluby',
            'token' => 'TYPE_NIGHT_CLUB',
        ]);

        PlaceType::create([
            'name' => 'Stacje',
            'token' => 'TYPE_TRAIN_STATION',
        ]);

        PlaceType::create([
            'name' => 'Sklepy',
            'token' => 'TYPE_STORE',
        ]);

        PlaceType::create([
            'name' => 'Restauracje',
            'token' => 'TYPE_RESTAURANT',
        ]);
    }
}
