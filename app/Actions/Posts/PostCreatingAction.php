<?php

namespace App\Actions\Posts;

use App\Actions\Complete;
use App\Actions\Failure;
use App\Actions\Reaction;
use App\Jobs\PostRenderingJob;
use App\Post;
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
 *  - 'description' (string)
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

        // Create the new post
        $post = Post::create([
            'title' => $data['title'],
            'content' => $data['content'],
            'description' => Arr::get($data, 'description'),
            'slug' => $this->generateSlug($data['title']),
            'author_id' => $data['author']->id,
        ]);

        if (! $post) {
            return new Failure('There was an error creating this new post.');
        }

        // Render the markdown into HTML
        PostRenderingJob::dispatch($post);

        // Add Tags to the post
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
        return (new PostTaggingAction)->execute([
            'post' => $post,
            'tags' => $slugs,
        ]);
    }
}
