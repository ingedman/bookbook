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
//         $this->call(UsersTableSeeder::class);
//        $lang = factory(App\Language::class)->create([
//            'name'=>'green'
//        ]);
//        factory(App\Book::class)->create();
//        factory(App\Review::class)->create();
//        factory(App\Reaction::class)->create();
//        factory(App\Author::class)->create();
//        factory(App\Book::class)->create();
//        factory(App\Report::class)->create();
//        factory(App\Comment::class)->create();
        for ($i = 0; $i < 20; $i++) {
            $user = factory(App\User::class)->create();
            if (in_array($i,[3,4,5,7])){
                App\User::find(1)->followings()->attach($user);
            }
            for ($j = 0; $j < 20; $j++) {
                factory(App\Review::class)->create([
                    'reviewer_id' => $user->id
                ]);
            }
        }

    }
}
