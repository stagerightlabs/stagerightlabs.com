<?php

namespace App\Actions\Posts;

use App\Actions\Complete;
use App\Actions\Failure;
use App\Actions\Reaction;
use App\Post;
use App\Tag;
use App\Utilities\Arr;
use Illuminate\Database\Eloquent\Collection;
use StageRightLabs\Actions\Action;

class PostTaggingAction extends Action
{
    /**
     * @var Post
     */
    public $post;

    /**
     * @var Collection|Tag
     */
    public $tags;

    /**
     * Sync tags with a post. Remove tags that are not specified in the tag
     * set and add tags in the tag set that are not already associated.
     *
     * @param Action|array $input
     * @return self
     */
    public function handle($input = [])
    {
        $this->post = $input['post'];

        $this->tags = $this->normalizeTagsIntoCollection(Arr::get($input, 'tags'));
        $this->post->tags()->sync($this->tags);
        $this->post->setRelation('tags', $this->tags);

        return $this->complete("Post {$this->post->reference_id} has been tagged.");
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

    /**
     * The input keys used in this action that are not required.
     *
     * @return array
     */
    public function optional()
    {
        return [
            'tags', // array|Collection
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
            'post', // App\Post
        ];
    }
}
