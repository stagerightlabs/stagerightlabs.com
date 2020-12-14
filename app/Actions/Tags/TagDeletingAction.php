<?php

namespace App\Actions\Tags;

use App\Tag;
use StageRightLabs\Actions\Action;

class TagDeletingAction extends Action
{
    /**
     * @var Tag
     */
    public $tag;

    /**
     * Remove a tag from the database.
     *
     * @param Action|array $input
     * @return self
     */
    public function handle($input = [])
    {
        $this->tag = $input['tag'];

        if ($input['tag']->posts()->exists()) {
            return $this->fail("Tag '{$this->tag->name}' cannot be removed; it is still in use.");
        }

        $input['tag']->delete();

        return $this->complete("Tag '{$input['tag']->name}' has been removed.");
    }

    /**
     * The input keys required by this action.
     *
     * @return array
     */
    public function required()
    {
        return [
            'tag', // Tag
        ];
    }
}
