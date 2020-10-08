<?php

namespace App\Actions\Snippets;

use App\Actions\Complete;
use App\Actions\Failure;
use App\Actions\Reaction;
use App\Jobs\SnippetRenderingJob;
use App\Snippet;
use App\Utilities\Arr;

/**
 * Create a new Snippet.
 *
 * Expected Input:
 *  - 'content' (string)
 *  - 'name' (string)
 *
 * Optional Input:
 *  - 'filename' (string)
 *  - 'language' (string)
 *  - 'starting_line' (integer)
 *  - 'url' (string)
 */
class SnippetCreatingAction
{
    /**
     * Execute the action.
     *
     * @param array $data
     * @return Reaction
     */
    public function execute($data = [])
    {
        if ($missing = Arr::disclose($data, ['name', 'content'])) {
            return new Failure("Missing expected '{$missing[0]}' value.");
        }

        $snippet = Snippet::create([
            'content' => $data['content'],
            'filename' => Arr::get($data, 'filename'),
            'language' => Arr::get($data, 'language'),
            'name' => $data['name'],
            'starting_line' => Arr::get($data, 'starting_line', 1),
            'url' => Arr::get($data, 'url'),
        ]);

        if (! $snippet) {
            return new Failure('There was an error creating the snippet');
        }

        dispatch(new SnippetRenderingJob($snippet));

        return new Complete("Snippet {$snippet->reference_id} created", [
            'snippet' => $snippet,
        ]);
    }
}
