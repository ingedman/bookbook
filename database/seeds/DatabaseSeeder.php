<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(LanguageSeeder::class);

        factory(App\User::class)->create([
            'name' => 'Eslam Fakhry',
            'email' => 'esl@m.com',
            'bio' => 'Full-stack web developer',
        ]);
        factory(App\User::class, 100)->create();


//        factory(App\Author::class, 100)->create([
//            'language_id' => function(){
//                return \App\Language::inRandomOrder()->first()->id;
//            }
//        ]);

//        factory(App\Book::class, 100)->create([
//            'poster_id' => function () {
//                return \App\User::inRandomOrder()->first()->id;
//            }
//        ]);

//        foreach (App\Book::all() as $book) {
//            $authorNum = rand(1, 4);
//            $authorIds = \App\Author::inRandomOrder()->take($authorNum)->pluck('id');
//            $book->authors()->sync($authorIds);
//        }
        $this->call(BookSeeder::class);


        factory(App\Review::class, 1000)->create([
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

        \App\User::find(1)->followings()->sync([2, 3, 4, 8, 10, 20, 8]);



    }
}
