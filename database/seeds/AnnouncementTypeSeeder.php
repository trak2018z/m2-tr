<?php

use App\AnnouncementType;
use Illuminate\Database\Seeder;

class AnnouncementTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        AnnouncementType::create([
            'name' => '',
            'token' => 'ANNOUNCEMENT_TYPE',
        ]);
        */

        AnnouncementType::create([
            'name' => 'Mieszkania',
            'token' => 'ANNOUNCEMENT_TYPE_FLATS',
        ]);

        AnnouncementType::create([
            'name' => 'Pokoje',
            'token' => 'ANNOUNCEMENT_TYPE_ROOMS',
        ]);

        AnnouncementType::create([
            'name' => 'Domy',
            'token' => 'ANNOUNCEMENT_TYPE_HOUSES',
        ]);
    }
}
