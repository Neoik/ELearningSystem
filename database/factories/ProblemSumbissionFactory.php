<?php

use Faker\Generator as Faker;

$factory->define(App\ProblemSumbission::class, function (Faker $faker) {
    return [
        'status' => App\ProblemSumbission::STATUS_ACCEPTED,
        'max_mem' => $faker->numberBetween(1, 256),
        'max_time' => $faker->randomFloat(1, 0, 5),
        'source_code' => '',
    ];
});
