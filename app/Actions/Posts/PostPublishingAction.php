<?php

namespace App\Actions\Posts;

use App\Actions\Complete;
use App\Actions\Failure;
use App\Actions\Reaction;
use App\Utilities\Arr;
use App\Utilities\Str;

/**
 * Publish a post.
 *
 * Expected Input:
 *  - 'post' (Post)
 */
class PostPublishingAction
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

        if (! $data['post']->published_at) {
            $data['post']->published_at = now();
            $data['post']->save();
        }

        return new Complete("Post {$data['post']->reference_id} has been published.", [
            'post' => $data['post'],
        ]);
    }
}
