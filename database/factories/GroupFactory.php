<?php

use App\Model\Group;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

/** @var Factory $factory */
$factory->define(Group::class, function (Faker $faker) {
    return [
        "name" => $faker->sentence(2),
    ];
});
