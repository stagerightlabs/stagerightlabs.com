<?php

namespace App\Actions\Snippets;

use App\Actions\Complete;
use App\Actions\Failure;
use App\Actions\Reaction;
use App\Snippet;
use App\Utilities\Arr;
use StageRightLabs\Actions\Action;

class SnippetDeletingAction extends Action
{
    /**
     * @var Snippet
     */
    public $snippet;

    /**
     * Remove a snippet from the database.
     *
     * @param Action|array $input
     * @return self
     */
    public function handle($input = [])
    {
        $this->snippet = $input['snippet'];

        $this->snippet->delete();

        return $this->complete("Snippet '{$this->snippet->reference_id}' has been removed.");
    }

    /**
     * The input keys required by this action.
     *
     * @return array
     */
    public function required()
    {
        return [
            'snippet', // Snippet
        ];
    }
}
