<?php

namespace App\Actions\Tags;

use App\Tag;
use App\Utilities\Str;
use Illuminate\Support\Facades\DB;
use StageRightLabs\Actions\Action;

class TagCreatingAction extends Action
{
    /**
     * @var Tag
     */
    public $tag;

    /**
     * Create a new tag.
     *
     * @param Action|array $input
     * @return self
     */
    public function handle($input = [])
    {
        $name = trim($input['name']);

        $this->tag = Tag::create([
            'name' => $name,
            'slug' => $this->generateSlug($name),
        ]);

        if (! $this->tag) {
            return $this->fail("The '{$name}' tag could not be created.");
        }

        return $this->complete("Tag '{$name}' has been created.");
    }

    /**
     * Generate a unique slug for the new tag.
     *
     * @param string $name
     * @return string
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

    /**
     * The input keys required by this action.
     *
     * @return array
     */
    public function required()
    {
        return [
            'name', // string
        ];
    }
}
