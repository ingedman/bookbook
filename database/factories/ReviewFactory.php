<?php

use Faker\Generator as Faker;

$factory->define(App\Review::class, function (Faker $faker) {
    $title = $faker->sentence;
    $slug = Str::slug($title);

    return [
        'reviewer_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'book_id' => function () {
            return factory(App\Book::class)->create()->id;
        },
        'language_id' => function () {
            return factory(App\Language::class)->create()->id;
        },
        'title' => $title,
        
        'content' => $faker->paragraph
    ];
});
