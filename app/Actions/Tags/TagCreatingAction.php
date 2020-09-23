<?php

namespace App\Actions\Tags;

use App\Actions\Complete;
use App\Actions\Failure;
use App\Actions\Reaction;
use App\Tag;
use App\Utilities\Arr;
use App\Utilities\Str;
use Illuminate\Support\Facades\DB;

/**
 * Create a new tag.
 *
 * Expected Input:
 *  - 'name' (string)
 */
class TagCreatingAction
{
    /**
     * Execute the action.
     *
     * @param array $data
     * @return Reaction
     */
    public function execute($data = [])
    {
        if ($missing = Arr::disclose($data, ['name'])) {
            return new Failure("Missing expected '{$missing[0]}' value.");
        }

        $tag = Tag::create([
            'name' => $data['name'],
            'slug' => $this->generateSlug($data['name']),
        ]);

        if (! $tag) {
            return new Failure("The '{$data['name']}' tag could not be created.");
        }

        return new Complete("Tag '' has been created.", [
            'tag' => $tag,
        ]);
    }

    /**
     * Generate a unique slug for the new tag.
     *
     * @param [type] $name
     * @return void
     */
    protected function generateSlug($name)
    {
        $attempts = 1;

        do {
            $slug = Str::slug($name);

            if ($attempts > 1) {
                $slug .= "-{$attempts}";
            }

            $attempts++;
        } while (DB::table('tags')->where('slug', $slug)->exists());

        return $slug;
    }
}
