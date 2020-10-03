<?php

namespace App\Actions\Posts;

use App\Actions\Complete;
use App\Actions\Failure;
use App\Actions\Reaction;
use App\Jobs\PostRenderingJob;
use App\Utilities\Arr;
use Illuminate\Support\Carbon;

/**
 * Update a post.
 *
 * Expected Input:
 *  - 'content' (string)
 *  - 'post' (Post)
 *  - 'title' (string)
 *
 * Optional Input:
 *  - 'author' (User)
 *  - 'description' (string)
 *  - 'tags' (array)
 *  - 'published_at' (string) yyyy-mm-dd
 */
class PostUpdatingAction
{
    /**
     * Execute the action.
     *
     * @param array $data
     * @return Reaction
     */
    public function execute($data = [])
    {
        if ($missing = Arr::disclose($data, ['content', 'post', 'title'])) {
            return new Failure("Missing expected '{$missing[0]}' value.");
        }

        // Update Post Attributes
        $post = $data['post'];
        $post->content = $data['content'];
        $post->description = Arr::get($data, 'description');
        $post->title = $data['title'];
        $post->slug = Arr::get($data, 'slug', $post->slug);
        $post->author_id = Arr::has($data, 'author')
            ? $data['author']->id
            : $post->author_id;

        // Update Publication Date
        if (Arr::has($data, 'published_at')) {
            $post->published_at = $this->resolvePublicationDate($data['published_at']);
        }

        // Save the post
        $post->save();

        // Update the post tags if they have been provided.
        if (Arr::has($data, 'tags')) {
            $this->updateTags($post, $data['tags']);
        }

        // Render the markdown into HTML
        PostRenderingJob::dispatch($post);

        return new Complete("Post {$post->reference_id} has been updated.", [
            'post' => $post,
        ]);
    }

    /**
     * Update the tags associated with this post.
     *
     * @param Post $post
     * @param array $tags
     * @return void
     */
    protected function updateTags($post, $slugs = [])
    {
        return (new PostTaggingAction)->execute([
            'post' => $post,
            'tags' => $slugs,
        ]);
    }

    /**
     * Resolve a date string into a carbon instance, if applicable.
     *
     * @param string $date
     * @return Carbon|null
     */
    protected function resolvePublicationDate($date)
    {
        if (empty($date)) {
            return null;
        }

        $carbon = null;

        try {
            $carbon = Carbon::parse(trim($date), 'America/Los_Angeles');
        } catch (\Throwable $th) {
            // ignore the failure and return null
        }

        return $carbon;
    }
}
