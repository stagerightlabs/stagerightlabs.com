<?php

namespace App\Actions\Snippets;

use App\Jobs\SnippetRenderingJob;
use App\Snippet;
use App\Utilities\Arr;
use StageRightLabs\Actions\Action;

class SnippetUpdatingAction extends Action
{
    /**
     * @var Snippet
     */
    public $snippet;

    /**
     * Update a snippet.
     *
     * @param Action|array $input
     * @return self
     */
    public function handle($input = [])
    {
        $this->snippet = $input['snippet'];

        $this->snippet->content = $input['content'];
        $this->snippet->filename = Arr::get($input, 'filename', $this->snippet->filename);
        $this->snippet->language = Arr::get($input, 'language', $this->snippet->language);
        $this->snippet->name = $input['name'];
        $this->snippet->starting_line = Arr::get($input, 'starting_line', $this->snippet->starting_line);
        $this->snippet->url = Arr::get($input, 'url', $this->snippet->url);

        $this->snippet->save();

        dispatch(new SnippetRenderingJob($this->snippet));

        return $this->complete("Snippet '{$this->snippet->reference_id}' has been updated.");
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
            'snippet', // Snippet
        ];
    }
}
