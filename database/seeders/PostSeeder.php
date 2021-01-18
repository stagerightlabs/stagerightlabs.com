<?php

namespace Database\Seeders;

use App\Actions\Posts\PostCreatingAction;
use App\Actions\Users\UserAccountCreatingAction;
use App\Tag;
use App\User;
use App\Utilities\Str;
use Exception;
use Faker\Generator;
use Illuminate\Database\Seeder;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(Generator $faker)
    {
        $author = $this->simulateAuthor($faker);
        $tags = Tag::pluck('slug');

        for ($i=0; $i < 20; $i++) {
            $action = PostCreatingAction::execute([
                'author' => $author,
                'content' => $faker->paragraphs(random_int(2, 6), true),
                'description' => $faker->sentences(random_int(2, 6), true),
                'title' => ucwords($faker->words(random_int(4, 8), true)),
                'tags' => $tags->random(random_int(0, 3)),
            ]);

            // Randomly decide if this post should be published.
            if ($faker->boolean()) {
                $action->post->published_at = $faker->dateTimeBetween('-5 years', 'now');
                $action->post->save();
            }
        }
    }

    /**
     * Find an existing user to use as the author for seeded posts,
     * or create a new user if none exist already.
     *
     * @param Generator $faker
     * @return User
     */
    protected function simulateAuthor($faker)
    {
        $author = User::where('email', 'ryan@stagerightlabs.com')->first();

        if ($author) {
            return $author;
        }

        $action = UserAccountCreatingAction::execute([
            'email' => $faker->safeEmail(), // string
            'name' => $faker->name(), // string
            'password' => Str::random(12), // string
        ]);

        if ($action->failed()) {
            throw new Exception($action->getMessage());
        }

        return $action->user;
    }
}
