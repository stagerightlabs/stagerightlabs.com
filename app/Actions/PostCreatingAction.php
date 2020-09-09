<?php

namespace App\Actions;

use App\Actions\Complete;
use App\Actions\Failure;
use App\Actions\Reaction;
use App\Post;
use App\Tag;
use App\Utilities\Arr;
use App\Utilities\Str;
use Illuminate\Support\Facades\DB;

/**
 * Create a new post.
 *
 * Expected Input:
 *  - 'author' (User)
 *  - 'content' (string)
 *  - 'title' (string)
 *
 * Optional Input:
 *  - 'tags' (array)
 */
class PostCreatingAction
{
    /**
     * Execute the action.
     *
     * @param array $data
     * @return Reaction
     */
    public function execute($data = [])
    {
        if ($missing = Arr::disclose($data, ['content', 'title'])) {
            return new Failure("Missing expected '{$missing[0]}' value.");
        }

        $post = Post::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'slug' => $this->generateSlug($data['title']),
            'author_id' => $data['author']->id,
        ]);

        if (!$post) {
            return new Failure("There was an error creating this new post.");
        }

        if ($tags = Arr::get($data, 'tags', null)) {
            $this->applyTags($post, $tags);
        }


        return new Complete("Post {$post->reference_id} has been created; it has not been published.", [
            'post' => $post,
        ]);
    }

    /**
     * Generate a slug for this post; it must be unique.
     *
     * @return string
     */
    protected function generateSlug($title)
    {
        $attempts = 1;

        do {
            $slug = Str::slug($title);

            if ($attempts > 1) {
                $slug .= "-{$attempts}";
            }

            $attempts++;
        } while (DB::table('posts')->where('slug', $slug)->exists());

        return $slug;
    }

    /**
     * Apply a set of tags to a post.
     *
     * @param Post $post
     * @param array[string] $slugs
     * @return void
     */
    protected function applyTags($post, $slugs)
    {
        $post->tags()->attach(
            Tag::whereIn('slug', $slugs)->get()
        );
    }
}
