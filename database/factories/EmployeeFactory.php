<?php

use Faker\Generator as Faker;

$factory->define(App\Employee::class, function (Faker $faker) {
    return [
        'date_of_birth' => $faker->dateTimeBetween('1990-01-01', '2012-12-31')->format('d/m/Y'),
        'image' => $faker->url,
        'email' => $faker->email,
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'title' => $faker->text(50),
        'address' => $faker->address,
        'country' => $faker->country,
        'bio' => $faker->text(200),
        'rating' => $faker->randomDigit
    ];
});
