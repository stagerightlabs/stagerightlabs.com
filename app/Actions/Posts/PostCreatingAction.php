<?php

namespace App\Actions\Posts;

use App\Jobs\PostRenderingJob;
use App\Post;
use App\Utilities\Arr;
use App\Utilities\Str;
use Illuminate\Support\Facades\DB;
use StageRightLabs\Actions\Action;

class PostCreatingAction extends Action
{
    /**
     * @var Post
     */
    public $post;

    /**
     * Create a new post.
     *
     * @param Action|array $input
     * @return self
     */
    public function handle($input = [])
    {
        // Create the new post
        $this->post = Post::create([
            'author_id' => $input['author']->id,
            'content' => $input['content'],
            'description' => Arr::get($input, 'description'),
            'slug' => $this->generateSlug($input['title']),
            'stack_outline' => Arr::get($input, 'stack_outline'),
            'title' => $input['title'],
        ]);

        if (! $this->post) {
            return $this->fail('There was an error creating this new post.');
        }

        // Render the markdown into HTML
        PostRenderingJob::dispatch($this->post);

        // Add Tags to the post
        if ($tags = Arr::get($input, 'tags', null)) {
            $this->applyTags($this->post, $tags);
        }

        return $this->complete("Post {$this->post->reference_id} has been created; it has not been published.");
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
        return PostTaggingAction::execute([
            'post' => $post,
            'tags' => $slugs,
        ]);
    }

    /**
     * The input keys used in this action that are not required.
     *
     * @return array
     */
    public function optional()
    {
        return [
            'description', // string
            'stack_outline', // string
            'tags', // array[string]
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
            'author', // App\User
            'content', // string
            'title', // string
        ];
    }
}
