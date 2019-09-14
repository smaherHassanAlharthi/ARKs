<?php

$factory->define(App\Control::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "status" => 0,
        "created_by_id" => factory('App\User')->create(),
    ];
});
