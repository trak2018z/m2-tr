<?php

use App\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*
        Role::create([
            'name' => '',
            'token' => '',
            'permissions' => 255
        ]);
        */

        Role::create([
            'name' => 'Administrator',
            'token' => 'ROLE_ADMIN',
            'permissions' => 127
        ]);

        Role::create([
            'name' => 'Właściciel Mieszkania',
            'token' => 'ROLE_OWNER',
            'permissions' => (1+2)
        ]);

        Role::create([
            'name' => 'Użytkownik',
            'token' => 'ROLE_USER',
            'permissions' => 1
        ]);
    }
}
