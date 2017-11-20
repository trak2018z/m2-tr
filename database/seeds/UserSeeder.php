<?php

use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
         User::create([
           'name' => 'example',
           'email' => 'example@example.com',
           'password' => bcrypt('pass'),
        ]);
         */

        User::create([
           'name' => 'admin0',
           'email' => 'hubertsad@o2.pl',
           'password' => bcrypt('HUBert123!'),
           'role_id' => 1,
        ]);
    }
}
