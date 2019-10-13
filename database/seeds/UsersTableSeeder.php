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
            'birthday' => '1997/08/23',
            'address' => 'Ուլնեցի փողոց շենք 72 բնակարան 30',
            'mobile' => '123123123132',
            'password' => '$2y$10$.bgi/8Bb9vFO2Lu0BLRGQOLWseyOTux9yqP7oShsKtYWxgHv6ssNS',
            'avatar' => '1570395596.png',
            'gender' => 'male',
            'agreed_to_terms' => 1,
            'role_id' => 1,
            'status_id' => 1,
          ],
          [
            'id' => '5eeaf3e9-0f8a-4a6f-b5e9-5d2c9ea603bb',
            'first_name' => 'Ruben',
            'last_name' => 'Suchyan',
            'birthday' => '1979/01/05',
            'mobile' => '+37477256005',
            'avatar' => '1570540877.png',
            'address' => null,
            'password' => '$2y$10$.bgi/8Bb9vFO2Lu0BLRGQOLWseyOTux9yqP7oShsKtYWxgHv6ssNS',
            'email' => 'rubensuchyan@gmail.com',
            'password' => '$2y$10$nyiwAVUSmrEPC2i5y9sT8uKBw4GXrHmarW8Re3Ag0bJs/94T8aJ36',
            'agreed_to_terms' => 1,
            'gender' => 'male',
            'role_id' => 1,
            'status_id' => 1,
          ],
          [
            'id' => '66156419-3575-45b0-b746-a946c0355323',
            'first_name' => 'Artak',
            'last_name' => 'Gaboyan',
            'birthday' => '1972/04/22',
            'mobile' => '-',
            'avatar' => 'default.png',
            'address' => 'Սվաճյան 62, բն 19',
            'password' => '$2y$10$.bgi/8Bb9vFO2Lu0BLRGQOLWseyOTux9yqP7oShsKtYWxgHv6ssNS',
            'email' => 'artak@artak.am',
            'password' => '$2y$10$.k.JHQdaFCcu9e5SMDxlpesJ7r99HHke/KTKEsDq7Peh5xtDGr1RW',
            'agreed_to_terms' => 1,
            'gender' => 'male',
            'role_id' => 2,
            'status_id' => 1,
          ]
        ]);
    }
}
