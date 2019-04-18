<?php

use Faker\Generator as Faker;

$factory->define(App\Report::class, function (Faker $faker) {
    $reportables = [
        App\Comment::class,
        App\Review::class,
        App\Author::class,
        App\Book::class,
        App\User::class,
    ];
    $reportableType = $faker->randomElement($reportables);

    return [
        'reportable_type' => $reportableType,
        'reportable_id'   => (function ($reportableType) {
            return factory($reportableType)->create()->id;
        })($reportableType),
        'reporter_id'         => function () {
            return factory(App\User::class)->create()->id;
        },
        'content'         => $faker->paragraph
    ];
});
