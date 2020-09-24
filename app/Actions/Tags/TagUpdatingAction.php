<?php

namespace App\Actions\Tags;

use App\Actions\Complete;
use App\Actions\Failure;
use App\Actions\Reaction;
use App\Utilities\Arr;

/**
 * Update a tag.
 *
 * Expected Input:
 *  - 'name' (string)
 *  - 'slug' (string)
 *  - 'tag' (Tag)
 */
class TagUpdatingAction
{
    /**
     * Execute the action.
     *
     * @param array $data
     * @return Reaction
     */
    public function execute($data = [])
    {
        if ($missing = Arr::disclose($data, ['name', 'tag'])) {
            return new Failure("Missing expected '{$missing[0]}' value.");
        }

        $data['tag']->name = $data['name'];
        $data['tag']->slug = Arr::get($data, 'slug', $data['tag']->slug);

        $data['tag']->save();

        return new Complete("Tag '{$data['tag']->name}' has been updated.", [
            'tag' => $data['tag'],
        ]);
    }
}
