<?php

use Faker\Generator as Faker;

$factory->define(App\Comment::class, function (Faker $faker) {
    return [
        'commentable_type' => App\Review::class,
        'commentable_id'   => function () {
            return factory(App\Review::class)->create()->id;
        },
        'user_id'         => function () {
            return factory(App\User::class)->create()->id;
        },
        'comment'         => $faker->paragraph
    ];
});
