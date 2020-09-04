<?php

namespace App\Actions\Snippets;

use App\Actions\Complete;
use App\Actions\Failure;
use App\Actions\Reaction;
use App\Snippet;
use App\Utilities\Arr;

/**
 * Modify a Snippet.
 *
 * Expected Input:
 *  - 'content' (string)
 *  - 'name' (string)
 *  - 'snippet' (Snippet)
 *
 * Optional Input:
 *  - 'filename' (string)
 *  - 'language' (string)
 *  - 'starting_line' (integer)
 *  - 'url' (string)
 */
class SnippetUpdateAction
{
    /**
     * Execute the action.
     *
     * @param array $data
     * @return Reaction
     */
    public function execute($data = [])
    {
        if ($missing = Arr::disclose($data, ['content', 'name', 'snippet'])) {
            return new Failure("Missing expected '{$missing[0]}' value.");
        }

        $snippet = $data['snippet'];

        $snippet->content = $data['content'];
        $snippet->filename = Arr::get($data, 'filename', $snippet->filename);
        $snippet->language = Arr::get($data, 'language', $snippet->language);
        $snippet->name = $data['name'];
        $snippet->starting_line = Arr::get($data, 'starting_line', $snippet->starting_line);
        $snippet->url = Arr::get($data, 'url', $snippet->url);

        $snippet->save();

        return new Complete("Snippet '{$snippet->reference_id}' has been updated.", [
            'snippet' => $snippet,
        ]);
    }
}
