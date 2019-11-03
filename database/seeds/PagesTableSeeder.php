<?php

use Illuminate\Database\Seeder;

class PagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('pages')->insert([
        //   [
        //     'id' => '1',
        //     'title_hy' => 'Գաղտնիության Քաղաքականություն',
        //     'title_en' => 'Privacy Policy',
        //     'title_ru' => ' Политика конфиденциальности',
        //   ],
        //   [
        //     'id' => '2',
        //     'title_hy' => 'Օգտագործման Համաձայնագիր',
        //     'title_en' => 'Terms of Service',
        //     'title_ru' => ' Условия использования',
        //   ]
        // ]);

        DB::table('pages')->insert([
          'id' => '3',
          'title_hy' => 'Հաճախ տրվող հարցեր',
          'title_en' => 'FAQ',
          'title_ru' => ' Вопросы-Ответы',
        ]);
    }
}
