<?php

namespace App\Actions\Posts;

use App\Post;
use StageRightLabs\Actions\Action;

class PostDeletingAction extends Action
{
    /**
     * @var Post
     */
    public $post;

    /**
     * Remove a post from the database.
     *
     * @param Action|array $input
     * @return self
     */
    public function handle($input = [])
    {
        $this->post = $input['post'];

        if ($this->post->hasBeenPublished()) {
            return $this->fail("Post {$this->post->reference_id} has been published and cannot be deleted.");
        }

        $this->post->delete();

        return $this->complete("Post {$this->post->reference_id} has been deleted.");
    }

    /**
     * The input keys required by this action.
     *
     * @return array
     */
    public function required()
    {
        return [
            'post',
        ];
    }
}
