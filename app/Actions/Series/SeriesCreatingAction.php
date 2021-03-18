<?php

namespace App\Actions\Series;

use App\Series;
use App\Utilities\Arr;
use App\Utilities\Str;
use Illuminate\Support\Facades\DB;
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
            'slug' => $this->generateSlug($input['name']),
        ]);

        return $this->complete("Created series: '{$this->series->name}'");
    }

    /**
     * Generate a slug for this series; it must be unique.
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
        } while (DB::table('series')->where('slug', $slug)->exists());

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
