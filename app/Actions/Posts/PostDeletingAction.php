<?php

namespace App\Actions\Posts;

use App\Actions\Complete;
use App\Actions\Failure;
use App\Actions\Reaction;
use App\Utilities\Arr;

/**
 * Remove a post from the database.
 *
 * Expected Input:
 *  - 'post' (Post)
 */
class PostDeletingAction
{
    /**
     * Execute the action.
     *
     * @param array $data
     * @return Reaction
     */
    public function execute($data = [])
    {
        if ($missing = Arr::disclose($data, ['post'])) {
            return new Failure("Missing expected '{$missing[0]}' value.");
        }

        if ($data['post']->hasBeenPublished()) {
            return new Failure("Post {$data['post']->reference_id} has been published and cannot be deleted.");
        }

        $data['post']->delete();

        return new Complete("Post {$data['post']->reference_id} has been deleted.");
    }
}
