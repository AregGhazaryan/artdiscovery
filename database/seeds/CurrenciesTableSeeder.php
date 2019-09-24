<?php

use Illuminate\Database\Seeder;

class CurrenciesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('currencies')->insert([
          [
            'id' => '5eeaf3e9-0f8a-4a6f-b5e9-5d2c9ea603b1',
            'code_numeric' => '051',
            'code_alpha' => 'AMD',
            'symbol' => '֏',
          ],
          [
            'id' => '5eeaf3e9-0f8a-4a6f-b5e9-5d2c9ea603b2',
            'code_numeric' => '840',
            'code_alpha' => 'USD',
            'symbol' => '$',
          ],
          [
            'id' => '5eeaf3e9-0f8a-4a6f-b5e9-5d2c9ea603b3',
            'code_numeric' => '810',
            'code_alpha' => 'RUB',
            'symbol' => '₽',
          ],
          [
            'id' => '5eeaf3e9-0f8a-4a6f-b5e9-5d2c9ea603b4',
            'code_numeric' => '978',
            'code_alpha' => 'EUR',
            'symbol' => '€',
          ],
        ]);
    }
}
