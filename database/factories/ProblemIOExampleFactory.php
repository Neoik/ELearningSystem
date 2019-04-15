<?php

use Faker\Generator as Faker;

/*
$table->increments('id');
$table->text('input');
$table->text('output');
$table->unsignedInteger('problem_id');
$table->foreign('problem_id')->references('id')->on('problems');
});
*/
$factory->define(App\ProblemIOExample::class, function (Faker $faker) {
    return [
        'input' => $faker->sentence(3),
        'output' => $faker->sentence(3),
    ];
});
