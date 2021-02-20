<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class PeopleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // \DB::table('v1.people')->insert(
        //     [
        //         'id' => '03563467307',
        //         'name' => 'Adriano',
        //     ]
        // );

        // \DB::table('v1.physical_people')->insert(
        //     [
        //         'person_id' => '03563467307',
        //         'birth_date' => '1988-06-21 00:00:00',
        //     ]
        // );

        \DB::table('v1.users')->insert(
            [
                'person_id' => '03563467307',
                'email' => 'adriano@gmail.com',
                'password' => '1234 ',
                'email_verified_at' => 'now()',
                'remember_token' => 'WqWqQjaksjaksjkasjka',
            ]
        );
    }
}
