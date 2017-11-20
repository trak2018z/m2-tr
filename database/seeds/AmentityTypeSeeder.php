<?php

use App\AmentityType;
use Illuminate\Database\Seeder;

class AmentityTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        AmentityType::create([
            'name' => '',
            'token' => 'AMENTITY_TYPE_',
        ]);
        */

        AmentityType::create([
            'name' => 'Ogólne',
            'token' => 'AMENTITY_TYPE_GENERAL',
        ]);

        AmentityType::create([
            'name' => 'Kuchnia',
            'token' => 'AMENTITY_TYPE_KITCHEN',
        ]);

        AmentityType::create([
            'name' => 'Łazienka',
            'token' => 'AMENTITY_TYPE_BATHROOM',
        ]);

        AmentityType::create([
            'name' => 'Salon',
            'token' => 'AMENTITY_TYPE_LIVING_ROOM',
        ]);

        AmentityType::create([
            'name' => 'Pokoje',
            'token' => 'AMENTITY_TYPE_ROOMS',
        ]);

    }
}
