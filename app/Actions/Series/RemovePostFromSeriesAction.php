<?php

namespace App\Actions\Series;

use App\Post;
use App\Series;
use StageRightLabs\Actions\Action;

/**
 * Remove a post from a series.
 *
 * Required:
 *  - post (Post)
 *  - series (Series)
 */
class RemovePostFromSeriesAction extends Action
{
    /**
     * The post being removed.
     *
     * @var Post
     */
    public $post;

    /**
     * The series being adjusted.
     *
     * @var Series
     */
    public $series;

    /**
     * Handle the action.
     *
     * @param Action|array $input
     * @return self
     */
    public function handle($input = [])
    {
        $this->post = $input['post'];
        $this->series = $input['series'];

        $this->series->posts()->detach($this->post->id);

        return $this->complete('action complete');
    }

    /**
     * The input keys required by this action.
     *
     * @return array
     */
    public function required()
    {
        return [
            'post', // Post
            'series', // Series
        ];
    }
}
