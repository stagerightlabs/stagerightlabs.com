<?php

namespace App\Actions\Series;

use Illuminate\Support\Facades\DB;
use StageRightLabs\Actions\Action;

/**
 * Add a post to a series.
 *
 * Required:
 *  - post (Post)
 *  - series (Series)
 */
class AddPostToSeriesAction extends Action
{
    /**
     * The post being added.
     *
     * @var Post
     */
    public $post;

    /**
     * The series receiving the post.
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

        $currentMaxSortOrder = DB::table('post_series')
            ->where('series_id', $this->series->id)
            ->max('sort_order') ?? -1;

        $this->series->posts()->attach($this->post->id, [
            'sort_order' => $currentMaxSortOrder + 1
        ]);

        return $this->complete("Post added to series '{$this->series->name}'");
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
