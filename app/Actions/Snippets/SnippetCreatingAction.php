<?php

namespace App\Actions\Snippets;

use App\Actions\Complete;
use App\Actions\Failure;
use App\Actions\Reaction;
use App\Jobs\SnippetRenderingJob;
use App\Snippet;
use App\Utilities\Arr;
use StageRightLabs\Actions\Action;

class SnippetCreatingAction extends Action
{
    /**
     * @var Snippet
     */
    public $snippet;

    /**
     * Create a new snippet.
     *
     * @param Action|array $input
     * @return self
     */
    public function handle($input = [])
    {
        $this->snippet = Snippet::create([
            'content' => $input['content'],
            'filename' => Arr::get($input, 'filename'),
            'language' => Arr::get($input, 'language'),
            'name' => $input['name'],
            'starting_line' => Arr::get($input, 'starting_line', 1),
            'url' => Arr::get($input, 'url'),
        ]);

        if (! $this->snippet) {
            return $this->fail('There was an error creating the snippet');
        }

        dispatch(new SnippetRenderingJob($this->snippet));

        return $this->complete("Snippet {$this->snippet->reference_id} created");
    }

    /**
     * The input keys used in this action that are not required.
     *
     * @return array
     */
    public function optional()
    {
        return [
            'filename', // string
            'language', // string
            'starting_line', // int
            'url', // string
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
            'name', // string
        ];
    }
}
