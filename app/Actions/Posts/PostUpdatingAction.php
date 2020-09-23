<?php

namespace App\Actions\Posts;

use App\Actions\Complete;
use App\Actions\Failure;
use App\Actions\Reaction;
use App\Tag;
use App\Utilities\Arr;
use App\Utilities\Str;
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
        $post->title = $data['title'];
        $post->slug = Arr::get($data, 'slug', $post->slug);
        $post->author_id = Arr::has($data, 'author')
            ? $data['author']->id
            : $post->author_id;

        // Update Publication Date
        if (Arr::has($data, 'published_at')) {
            $post->published_at = empty($data['published_at'])
                ? null
                : Carbon::createFromFormat('Y-m-d', $data['published_at'], 'America/Los_Angeles');
        }

        // Render the markdown into HTML
        $rendering = (new PostRenderingAction)->execute([
            'post' => $post,
        ]);

        if ($rendering->failed()) {
            return $rendering;
        }

        $post->rendered = $rendering->rendered;

        // Save the post
        $post->save();

        // Update the post tags if they have been provided.
        if (Arr::has($data, 'tags')) {
            $this->updateTags($post, $data['tags']);
        }

        return new Complete("Post {$post->reference_id} has been updated.", [
            'post' => $rendering->post,
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
}
