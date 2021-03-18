<?php

namespace App\Actions\Series;

use App\Series;
use StageRightLabs\Actions\Action;

/**
 * Remove a series from the database.
 *
 * Required:
 *  - series (Series)
 */
class SeriesDeletingAction extends Action
{
    /**
     * The series to be removed.
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

        if ($this->series->posts->count() > 0) {
            return $this->fail('You cannot delete a series that contains posts.');
        }

        $this->series->delete();

        return $this->complete("Series '{$this->series->name}' has been deleted.");
    }

    /**
     * The input keys required by this action.
     *
     * @return array
     */
    public function required()
    {
        return [
            'series', // Series
        ];
    }
}
