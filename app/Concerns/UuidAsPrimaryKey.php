<?php

namespace App\Concerns;

use App\Utilities\Str;

/**
 * Allow a model to use a UUID as its primary key.
 *
 * https://dev.to/wilburpowery/easily-use-uuids-in-laravel-45be
 */
trait UuidAsPrimaryKey
{
    /**
     * Establish model event callbacks when a model is booted.
     *
     * @return void
     */
    protected static function bootUuidAsPrimaryKey()
    {
        // Generate a new UUID when creating new models
        static::creating(function ($model) {
            if (! $model->getKey()) {
                $model->{$model->getKeyName()} = (string) Str::uuid();
            }
        });
    }

    /**
     * Get the value indicating whether the IDs are incrementing.
     *
     * @return bool
     */
    public function getIncrementing()
    {
        return false;
    }

    /**
     * Get the auto-incrementing key type.
     *
     * @return string
     */
    public function getKeyType()
    {
        return 'string';
    }
}
