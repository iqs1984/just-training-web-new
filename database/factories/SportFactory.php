<?php

use App\Model\Sport;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(Sport::class, function (Faker $faker) {
    return [
        "name" => $faker->sentence(1) . $faker->randomNumber()
    ];
});
