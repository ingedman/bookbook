<?php

use App\Book;
use Faker\Generator as Faker;
use Illuminate\Support\Str;

$factory->define(Book::class, function (Faker $faker) {
    $title = $faker->sentence;
    $slug = Str::slug($title);


    return [
        'year'      => $faker->year,
        'title'      => $title,
        'genre'     => 'horror',
        'cover'     => $faker->imageUrl(),
        'poster_id' => function () {
            return factory(App\User::class)->create()->id;
        }
    ];
});
