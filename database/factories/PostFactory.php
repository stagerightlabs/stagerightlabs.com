<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Post;
use App\User;
use App\Utilities\Arr;
use App\Utilities\Str;
use Faker\Generator as Faker;

$factory->define(Post::class, function (Faker $faker, $attributes) {
    $title = Arr::get($attributes, 'name', $faker->sentence());
    $slug = Arr::get($attributes, 'slug', Str::slug($title));

    return [
        'author_id' => function() {
            return factory(User::class)->create()->id;
        },
        'content' => $faker->paragraph(),
        'published_at' => null,
        'slug' => $slug,
        'title' => $title,
    ];
});
