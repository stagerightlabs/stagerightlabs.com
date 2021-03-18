<?php

namespace App;

use App\Concerns\ReferenceIds;
use App\Concerns\UuidAsPrimaryKey;
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
        return 'SR'.Str::safeRandom(6);
    }

    /**
     * The posts associated with this series.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function posts()
    {
        return $this->belongsToMany(Post::class)
            ->withPivot('sort_order')
            ->orderByPivot('sort_order');
    }

    /**
     * The posts associated with this series that have been published.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function publishedPosts()
    {
        return $this->posts()->whereNotNull('posts.published_at');
    }

    /**
     * Scope a query to only include series that contain published posts.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopeContainingPublishedPosts($query)
    {
        return $query->join('post_series', 'post_series.series_id', '=', 'series.id')
            ->join('posts', 'posts.id', '=', 'post_series.post_id')
            ->whereNotNull('posts.published_at')
            ->select('series.*');
    }
}
