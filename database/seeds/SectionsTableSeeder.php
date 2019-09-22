<?php

use Illuminate\Database\Seeder;

class SectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('sections')->insert([
            [
                'id' => 1,
                'title_en' => 'Art',
                'title_hy' => 'Արվեստ',
                'title_ru' => 'Искусство',
                'color' => 'FF1736',
            ],
            [
                'id' => 2,
                'title_en' => 'Music',
                'title_hy' => 'Երաժշտություն',
                'title_ru' => 'Музыка',
                'color' => '6600FF',
            ],
            [
                'id' => 3,
                'title_en' => 'History',
                'title_hy' => 'Պատմություն',
                'title_ru' => 'История',
                'color' => '006EFF',
            ]
        ]);
    }
}
