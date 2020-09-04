<?php

namespace App\Actions\Tags;

use App\Actions\Complete;
use App\Actions\Failure;
use App\Actions\Reaction;
use App\Utilities\Arr;

/**
 * Remove a tag from the database.
 *
 * Expected Input:
 *  - 'tag' (Tag)
 */
class TagDeletionAction
{
    /**
     * Execute the action.
     *
     * @param array $data
     * @return Reaction
     */
    public function execute($data = [])
    {
        if ($missing = Arr::disclose($data, ['tag'])) {
            return new Failure("Missing expected '{$missing[0]}' value.");
        }

        $data['tag']->delete();

        return new Complete("Tag {$data['tag']->name} has been removed.", [
            'tag' => $data['tag'],
        ]);
    }
}
