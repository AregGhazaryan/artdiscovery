<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
          [
            'id' => 'f924913b-9a0c-4ad1-8925-efbf668c39fa',
            'first_name' => 'Areg',
            'last_name' => 'Ghazaryan',
            'email' => 'areg.areg51@gmail.com',
            'mobile' => '123123123132',
            'password' => '$2y$10$.bgi/8Bb9vFO2Lu0BLRGQOLWseyOTux9yqP7oShsKtYWxgHv6ssNS',
            'gender' => 'male',
            'agreed_to_terms' => 1,
            'type' => 'admin',
          ],
          [
            'id' => '5eeaf3e9-0f8a-4a6f-b5e9-5d2c9ea603bb',
            'first_name' => 'Ruben',
            'last_name' => 'Suchyan',
            'mobile' => '123123123132',
            'password' => '$2y$10$.bgi/8Bb9vFO2Lu0BLRGQOLWseyOTux9yqP7oShsKtYWxgHv6ssNS',
            'email' => 'rubensuchyan@gmail.com',
            'password' => '$2y$10$nyiwAVUSmrEPC2i5y9sT8uKBw4GXrHmarW8Re3Ag0bJs/94T8aJ36',
            'agreed_to_terms' => 1,
            'gender' => 'male',
            'type' => 'admin',
          ]
        ]);
    }
}
