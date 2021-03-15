<?php

namespace App;

use App\Concerns\ReferenceIds;
use App\Concerns\UuidAsPrimaryKey;
use App\Post;
use App\Utilities\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Series extends Model
{
    use HasFactory;
    use ReferenceIds;
    use UuidAsPrimaryKey;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'series';

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
        return 'SR' . Str::safeRandom(6);
    }

    /**
     * The posts associated with this series.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class)
            ->withPivot('sort_order');
    }
}
