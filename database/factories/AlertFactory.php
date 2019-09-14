<?php

$factory->define(App\Alert::class, function (Faker\Generator $faker) {
    return [
        "date" => $faker->date("Y-m-d", $max = 'now'),
        "score" => $faker->randomNumber(2),
        "type" => $faker->name,
        "controller_id" => factory('App\Control')->create(),
        "created_by_id" => factory('App\User')->create(),
    ];
});
