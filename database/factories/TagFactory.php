<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tag;
use App\Utilities\Arr;
use App\Utilities\Str;
use Faker\Generator as Faker;

$factory->define(Tag::class, function (Faker $faker, $attributes) {
    $name = Arr::get($attributes, 'name', $faker->words(3, $asText = true));
    $slug = Arr::get($attributes, 'slug', Str::slug($name));

    return [
        'name' => $name,
        'slug' => $slug,
    ];
});
