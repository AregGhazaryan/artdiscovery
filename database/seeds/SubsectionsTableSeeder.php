<?php

use Illuminate\Database\Seeder;

class SubsectionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('subsections')->insert([
            [
                'id' => 1,
                'title_en' => 'Renaissance Art',
                'title_hy' => 'Վերածննդի Արվեստ',
                'title_ru' => 'Искусство эпохи Возрождения',
                'color' => 'FF1730',
                'section_id' => 1,
            ],
            [
                'id' => 2,
                'title_en' => 'Classic Music',
                'title_hy' => 'Դասական Երաժշտություն',
                'title_ru' => 'Классическая музыка',
                'color' => '6600F0',
                'section_id' => 2,
            ],
            [
                'id' => 3,
                'title_en' => 'Medieval History',
                'title_hy' => 'Միջնադարի Պատմություն',
                'title_ru' => 'Средневековая история',
                'color' => '006EF0',
                'section_id' => 3,
            ],
            [
              'id' => 4,
              'title_en' => 'Victorian Era',
              'title_hy' => 'Վիկտորյական դարաշրջան',
              'title_ru' => 'Викторианская эпоха',
              'color' => '006EF8',
              'section_id' => 1,
          ]
        ]);
    }
}
