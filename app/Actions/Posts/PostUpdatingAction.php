<?php

namespace App\Actions\Posts;

use App\Actions\Failure;
use App\Jobs\PostRenderingJob;
use App\Post;
use App\Utilities\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Cache;
use StageRightLabs\Actions\Action;

class PostUpdatingAction extends Action
{
    /**
     * @var Post
     */
    public $post;

    /**
     * Update a post.
     *
     * @param Action|array $input
     * @return self
     */
    public function handle($input = [])
    {
        $this->post = $input['post'];

        // Update Post Attributes
        $this->post->content = $input['content'];
        $this->post->description = Arr::get($input, 'description');
        $this->post->title = $input['title'];
        $this->post->slug = Arr::get($input, 'slug', $this->post->slug);
        $this->post->author_id = Arr::has($input, 'author')
            ? $input['author']->id
            : $this->post->author_id;

        // Update Publication Date
        if (Arr::has($input, 'published_at')) {
            $this->post->published_at = $this->resolvePublicationDate($input['published_at']);
            Cache::forget('rss.posts');
        }

        // Save the post
        $this->post->save();

        // Update the post tags if they have been provided.
        if (Arr::has($input, 'tags')) {
            $this->updateTags($input['tags']);
        }

        // Render the markdown into HTML
        PostRenderingJob::dispatch($this->post);

        return $this->complete("Post {$this->post->reference_id} has been updated.");
    }

    /**
     * Update the tags associated with this post.
     *
     * @param array $tags
     * @return void
     */
    protected function updateTags($slugs = [])
    {
        return PostTaggingAction::execute([
            'post' => $this->post,
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
            return;
        }

        $carbon = null;

        try {
            $carbon = Carbon::parse(trim($date), 'America/Los_Angeles');
        } catch (\Throwable $th) {
            // ignore the failure and return null
        }

        return $carbon;
    }

    /**
     * The input keys used in this action that are not required.
     *
     * @return array
     */
    public function optional()
    {
        return [
            'author', // User
            'content', // string
            'description', // string
            'slug', // string
            'tags', // array
            'published_at', // string: yyyy-mm-dd
        ];
    }

    /**
     * The input keys required by this action.
     *
     * @return array
     */
    public function required()
    {
        return [
            'content', // string
            'post', // Post
            'title', // string
        ];
    }
}
