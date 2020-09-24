<?php

namespace App\Actions\Posts;

use App\Actions\Complete;
use App\Actions\Failure;
use App\Actions\Reaction;
use App\Tag;
use App\Utilities\Arr;
use Illuminate\Database\Eloquent\Collection;

/**
 * Sync tags with a post. Remove tags that are not specified in the tag set and
 * add tags in the tag set that are not already associated with the model.
 *
 * Expected Input:
 *  - 'post' App\Post
 *
 * Optional Input:
 *  - `tags` array|Collection
 */
class PostTaggingAction
{
    /**
     * Execute the action.
     *
     * @param array $data
     * @return Reaction
     */
    public function execute($data = [])
    {
        if ($missing = Arr::disclose($data, ['post'])) {
            return new Failure("Missing expected '{$missing[0]}' value.");
        }

        $tags = $this->normalizeTagsIntoCollection(Arr::get($data, 'tags'));
        $data['post']->tags()->sync($tags);
        $data['post']->setRelation('tags', $tags);

        return new Complete("Post {$data['post']->reference_id} has been tagged.", [
            'post' => $data['post']->fresh(),
            'tags' => $tags,
        ]);
    }

    /**
     * Convert our tag set into a collection of tag models.
     *
     * @param mixed $tags
     * @return Collection
     */
    protected function normalizeTagsIntoCollection($tags)
    {
        // Return an empty collection if we have nothing to work with.
        if (is_null($tags) || empty($tags)) {
            return new Collection();
        }

        // If this is an array wrap it in a collection.
        if (is_array($tags)) {
            $tags = new Collection($tags);
        }

        // If this is a single tag we will wrap it in a collection.
        if (! $tags instanceof \Illuminate\Support\Collection) {
            $tags = new Collection([$tags]);
        }

        // Tags may either be models or string slugs; convert them all to models.
        $tags = $tags->map(function ($tag) {
            if (is_string($tag)) {
                return Tag::findBySlug($tag);
            }

            return $tag;
        })
        ->filter();

        // Ensure we always return an Eloquent collection
        // instead of a support collection.
        return new Collection($tags->all());
    }
}
