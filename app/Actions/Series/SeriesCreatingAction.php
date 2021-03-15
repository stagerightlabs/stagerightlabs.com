<?php

namespace App\Actions\Series;

use App\Series;
use App\Utilities\Arr;
use StageRightLabs\Actions\Action;

/**
 * Create a new series.
 *
 * Required:
 *  - name (string)
 *
 * Optional:
 *  - description (string)
 */
class SeriesCreatingAction extends Action
{
    /**
     * The series that has been created.
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
        $this->series = Series::create([
            'name' => $input['name'],
            'description' => Arr::get($input, 'description'),
        ]);

        return $this->complete("Created series: '{$this->series->name}'");
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
