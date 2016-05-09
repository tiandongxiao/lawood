<?php

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
    $user_ids = \App\User::lists('id')->toArray();
    return [
        'user_id' => $faker->randomElement($user_ids),
        'type' => $faker->word,
        'title' => $faker->title,
        'content' => $faker->sentence(6),
        'url' => $faker->url,
        'read' => $faker->boolean
    ];
});

