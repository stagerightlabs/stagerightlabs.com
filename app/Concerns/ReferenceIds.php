<?php

namespace App\Concerns;

use App\Utilities\Str;

/**
 * Add reference ID methods to an eloquent model.
 */
trait ReferenceIds
{
    /**
     * Set up model event listeners.
     *
     * @return void
     */
    protected static function bootReferenceIds()
    {
        // Generate a new reference ID upon model creation.
        static::creating(function ($model) {
            $model->reference_id = $model::generateReferenceId();
        });
    }

    /**
     * Find a model by reference Id.
     *
     * @param string $referenceId
     * @return self|null
     */
    public static function findByReferenceId($referenceId)
    {
        return self::query()->where('reference_id', $referenceId)->first();
    }

    /**
     * Generate a new reference ID for this model type.
     *
     * @return string
     */
    abstract public static function generateReferenceId();
}
