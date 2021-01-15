<?php

namespace Database\Factories;

use App\Snippet;
use Illuminate\Database\Eloquent\Factories\Factory;

class SnippetFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Snippet::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'name' => $this->faker->words(3, $asText = true),
            'content' => $this->faker->paragraph(),
            'is_public' => false,
        ];
    }

    /**
     * Indicate that the post has been published.
     *
     * @return void
     */
    public function public()
    {
        return $this->state(function (array $attributes) {
            return [
                'is_public' => true,
            ];
        });
    }
}
