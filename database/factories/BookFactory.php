<?php

use App\Book;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Book::class, function (Faker $faker) {

    return [
        'year'      => $faker->year,
        'title'      => $faker->sentence,
        'genre'     => 'fiction',
        'cover'     => $faker->imageUrl(),
        'poster_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});

//$factory->afterCreating(Book::class, function ($book, $faker) {
//    $book->authors()->save(factory(App\Author::class)->make());
//    $book->languages()->save(factory(App\Language::class)->make());
//    $book->languages()->save(factory(App\Language::class)->make());
//    $book->nativeLanguage()->save(factory(App\Language::class)->make());
//
//});