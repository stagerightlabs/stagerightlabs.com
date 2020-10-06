<?php

namespace App;

use App\Concerns\ReferenceIds;
use App\Concerns\UuidAsPrimaryKey;
use App\Utilities\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    use HasFactory, ReferenceIds, UuidAsPrimaryKey;

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
     * The posts associated with this tag.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function posts()
    {
        return $this->morphedByMany(Post::class, 'taggable');
    }

    /**
     * Generate a new reference ID for this model type.
     *
     * @return string
     */
    public static function generateReferenceId()
    {
        return 'TAG'.Str::safeRandom(5);
    }

    /**
     * Find a tag by its slug.
     *
     * @param string $slug
     * @return self|null
     */
    public static function findBySlug($slug)
    {
        return self::query()->where('slug', $slug)->first();
    }
}
