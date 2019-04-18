<?php

use Faker\Generator as Faker;

$factory->define(App\Reaction::class, function (Faker $faker) {
    $reactionables = [
        App\Comment::class,
        App\Review::class,
    ];


    $reactionableType = $faker->randomElement($reactionables);
    return [
        'reactionable_type' => $reactionableType,
        'reactionable_id' => (function ($reactionableType) {
            return factory($reactionableType)->create()->id;
        })($reactionableType),
        'user_id' => function () {
            return factory(App\User::class)->create()->id;
        },
        'is_like' => true,
    ];
});
