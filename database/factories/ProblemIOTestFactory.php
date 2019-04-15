<?php

use Faker\Generator as Faker;

$factory->define(App\ProblemIOTest::class, function (Faker $faker) {
    return [
      'input' => $faker->sentence(3),
      'output' => $faker->sentence(3),
    ];
});
