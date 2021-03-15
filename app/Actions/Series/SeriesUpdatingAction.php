<?php

namespace App\Actions\Series;

use App\Series;
use App\Utilities\Arr;
use StageRightLabs\Actions\Action;

/**
 * Update a series
 *
 * Required:
 *  - name (string)
 *  - series (Series)
 *
 * Optional:
 *  - description (string)
 */
class SeriesUpdatingAction extends Action
{
    /**
     * The series that has been updated.
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

        $this->series->name = $input['name'];
        $this->series->description = Arr::get($input, 'description');

        $this->series->save();

        return $this->complete("Series updated: '{$this->series->name}'");
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
            'series', // Series
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
            'description', // string
        ];
    }
}
