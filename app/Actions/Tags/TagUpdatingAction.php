<?php

namespace App\Actions\Tags;

use App\Tag;
use App\Utilities\Arr;
use StageRightLabs\Actions\Action;

class TagUpdatingAction extends Action
{
    /**
     * @var Tag
     */
    public $tag;

    /**
     * Update a tag.
     *
     * @param Action|array $input
     * @return self
     */
    public function handle($input = [])
    {
        $this->tag = $input['tag'];
        $this->tag->name = $input['name'];
        $this->tag->slug = Arr::get($input, 'slug', $this->tag->slug);

        $this->tag->save();

        return $this->complete("Tag '{$this->tag->name}' has been updated.");
    }

    /**
     * The input keys required by this action.
     *
     * @return array
     */
    public function required()
    {
        return [
            'name', // string
            'tag', // Tag
        ];
    }

    /**
     * The input keys used in this action that are not required.
     *
     * @return array
     */
    public function optional()
    {
        return [
            'slug', // string
        ];
    }
}
