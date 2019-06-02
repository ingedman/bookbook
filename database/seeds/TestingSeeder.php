<?php

use Illuminate\Database\Seeder;

class TestingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $languages = [
            'ab' => 'Abkhazian',
            'aa' => 'Afar',
            'af' => 'Afrikaans',
            'ak' => 'Akan',
            'sq' => 'Albanian',
            'am' => 'Amharic',
            'ar' => 'Arabic',
            'an' => 'Aragonese',
            'hy' => 'Armenian',
        ];
        foreach ($languages as $code => $language){
            factory(App\Language::class)->create([
                'code' =>$code,
                'name'=>$language
            ]);
        }
        factory(App\User::class, 10)->create();
        factory(App\Book::class, 10)->create();
        factory(App\Review::class, 10)->create([
            'reviewer_id' => function () {
                return \App\User::inRandomOrder()->first()->id;
            },
            'book_id' => function () {
                return \App\Book::inRandomOrder()->first()->id;
            },
            'language_id' => function () {
                return \App\Language::inRandomOrder()->first()->id;
            },
        ]);

    }
}
