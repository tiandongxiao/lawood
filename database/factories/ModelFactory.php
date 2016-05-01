<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Place::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'price' => $faker->randomNumber(),
        'avatar' => $faker->imageUrl(),
        'desc' => str_random(10),
        'address' => str_random(16),
        'attach'  => str_random()
    ];
});

$factory->define(App\Notification::class, function (Faker\Generator $faker) {
    return [
        'user_id' => \App\User::where('email','lawyer@lawood.cn')->first()->id,
        'type' => $faker->word,
        'title' => $faker->title,
        'content' => $faker->sentence(6),
        'url' => $faker->url,
        'read' => $faker->boolean
    ];
});
