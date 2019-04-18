<?php

use Faker\Generator as Faker;

$factory->define(App\Author::class, function (Faker $faker) {


    return [
        'name'   => $faker->name,
        'language_id'  =>function () {
            return factory(App\Language::class)->create()->id;
        },
    ];
});
