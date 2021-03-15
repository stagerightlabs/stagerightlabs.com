<?php

namespace App\Actions\Series;

use App\Series;
use Illuminate\Support\Facades\DB;
use StageRightLabs\Actions\Action;

/**
 * Change the sort order for posts in a series.
 *
 * Required:
 *  - order (array)
 *  - series (Series)
 *
 * Format for the 'order' array:
 *   [
 *     $post->id => 0,
 *     $post->id => 1,
 *     // etc
 *   ]
 */
class ChangeSortOrderAction extends Action
{
    /**
     * The series being updated.
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
        $this->series = $input['series'];

        collect($input['order'])
            ->each(function($order, $id) {
                $this->series->posts()->updateExistingPivot($id, [
                    'sort_order' => $order,
                ]);
            });

        return $this->complete("Sort order updated for '{$this->series->name}'");
    }

    /**
     * The input keys required by this action.
     *
     * @return array
     */
    public function required()
    {
        return [
            'order', // array
            'series', // Series
        ];
    }
}
