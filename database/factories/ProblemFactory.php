<?php

use Faker\Generator as Faker;

$factory->define(App\Problem::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(3),
        'description' => $faker->text,
        'input_description' => $faker->paragraph(3),
        'output_description' => $faker->paragraph(3),
        'max_mem' => $faker->numberBetween(1, 256),
        'max_time' => $faker->numberBetween(1, 5),
        'submit_count' => $faker->numberBetween(0, 1000),
        'solve_count' => $faker->numberBetween(0, 1000),
    ];
});
