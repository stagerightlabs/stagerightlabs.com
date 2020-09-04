<?php

namespace App;

use App\Concerns\ReferenceIds;
use App\Concerns\UuidAsPrimaryKey;
use App\Utilities\Str;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use ReferenceIds, UuidAsPrimaryKey;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
    }

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'tags';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * Generate a new reference ID for this model type.
     *
     * @return string
     */
    public static function generateReferenceId()
    {
        return 'TAG'.Str::safeRandom(5);
    }
}
