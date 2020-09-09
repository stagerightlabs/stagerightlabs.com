<?php

namespace App\Actions\Posts;

use App\Actions\Complete;
use App\Actions\Failure;
use App\Actions\Reaction;
use App\Tag;
use App\Utilities\Arr;
use App\Utilities\Str;

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

        $post = $data['post'];
        $post->content = $data['content'];
        $post->title = $data['title'];
        $post->slug = Arr::get($data, 'slug', $post->slug);
        $post->author_id = Arr::has($data, 'author')
            ? $data['author']->id
            : $post->author_id;

        if (Arr::has($data, 'tags')) {
            $this->updateTags($post, $data['tags']);
        }

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
    protected function updateTags($post, $tags = [])
    {
        $tags = Tag::whereIn('slug', $tags)->get();

        $post->tags()->sync($tags);
    }
}
