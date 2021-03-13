<?php

namespace Database\Factories;

use App\Post;
use App\User;
use App\Utilities\Str;
use Illuminate\Database\Eloquent\Factories\Factory;

class PostFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Post::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'author_id' => User::factory(),
            'content' => $this->faker->paragraph(),
            'description' => $this->faker->words(6, true),
            'published_at' => null,
            'slug' => Str::slug($this->faker->sentence()),
            'stack_outline' => $this->faker->optional()->paragraph(),
            'title' => $this->faker->sentence(),
        ];
    }

    /**
     * Indicate that the post has been published.
     *
     * @return void
     */
    public function published()
    {
        return $this->state(function (array $attributes) {
            return [
                'published_at' => now()->subWeeks(2),
            ];
        });
    }

    /**
     * Indicate that the post has been published.
     *
     * @return void
     */
    public function draft()
    {
        return $this->state(function (array $attributes) {
            return [
                'published_at' => null,
            ];
        });
    }
}
