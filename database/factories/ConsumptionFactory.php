<?php

$factory->define(App\Consumption::class, function (Faker\Generator $faker) {
    return [
        "liters" => $faker->randomNumber(2),
        "cost" => $faker->randomNumber(2),
        "date" => $faker->date("Y-m-d", $max = 'now'),
        "control_id" => factory('App\Control')->create(),
    ];
});
