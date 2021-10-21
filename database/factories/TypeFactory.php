<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Type;
use Faker\Generator as Faker;

$factory->define(Type::class, function (Faker $faker) {
    return [
        'title' => $faker->name(),
        'description' => $faker->sentence(100),
    ];
});
