<?php

namespace App\Actions\Snippets;

use App\Actions\Complete;
use App\Actions\Failure;
use App\Actions\Reaction;
use App\Utilities\Arr;
use App\Utilities\Str;

/**
 * Remove a snippet from the database.
 *
 * Expected Input:
 *  - 'snippet' (Snippet)
 */
class SnippetDeletionAction
{
    /**
     * Execute the action.
     *
     * @param array $data
     * @return Reaction
     */
    public function execute($data = [])
    {
        if ($missing = Arr::disclose($data, ['snippet'])) {
            return new Failure("Missing expected '{$missing[0]}' value.");
        }

        $data['snippet']->delete();

        return new Complete("Snippet '{$data['snippet']->reference_id}' has been removed.", [
            'snippet' => $data['snippet'],
        ]);
    }
}
