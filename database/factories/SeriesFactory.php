<?php

namespace Database\Factories;

use App\Series;
use App\Utilities\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class SeriesFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Series::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $name = $this->faker->words(6, $asText = true);

        return [
            'name' => $name,
            'slug' => Str::slug($name),
        ];
    }
}
