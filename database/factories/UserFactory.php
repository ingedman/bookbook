<?php



use App\User;
use Illuminate\Support\Str;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'bio' => $faker->paragraph,
        'avatar' => $faker->imageUrl(120,120),
        'email_verified_at' => now(),
        'password' => '$2y$10$u44M9HhFuUE0iJhdEKeHRuW1903ulol1ZgvWduLOVQfs9MECzYxoC', // password
        'remember_token' => Str::random(10),
    ];
});

//$factory->afterCreating(App\User::class, function ($user, $faker) {
//    $user->accounts()->save(factory(App\Account::class)->make());
//});
