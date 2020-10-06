<?php

namespace Database\Factories;

use App\Tag;
use App\Utilities\Arr;
use App\Utilities\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class TagFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Tag::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(2, $asText = true),
            'slug' => Str::slug($this->faker->words(2, $asText = true)),
        ];
    }
}
