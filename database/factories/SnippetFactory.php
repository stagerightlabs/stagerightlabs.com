<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Snippet;
use Faker\Generator as Faker;

$factory->define(Snippet::class, function (Faker $faker) {
    return [
        'name' => $faker->words(3, $asText = true),
        'content' => $faker->paragraph(),
    ];
});
