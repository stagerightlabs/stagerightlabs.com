<?php

namespace App;

use App\Concerns\ReferenceIds;
use App\Concerns\UuidAsPrimaryKey;
use App\Utilities\Arr;
use App\Utilities\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory, UuidAsPrimaryKey, ReferenceIds;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'posts';

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'published_at' => 'datetime',
    ];

    /**
     * Generate a new reference ID for this model type.
     *
     * @return string
     */
    public static function generateReferenceId()
    {
        return 'PT'.Str::safeRandom(6);
    }

    /**
     * The tags associated with this post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable')
            ->orderBy('name');
    }

    /**
     * The shortcodes referenced in the post content.
     *
     * @return Collection
     */
    public function getShortcodesAttribute()
    {
        preg_match_all('/\[\[+[a-zA-Z0-9\s]+\]\]/', $this->content, $matches, PREG_OFFSET_CAPTURE);

        return collect($matches[0])
            ->map(function ($match) {
                return [
                    'original' => $match[0],
                    'offset' => $match[1],
                    'length' => strlen($match[0]),
                    'code' => str_replace(['[', ']'], '', $match[0]),
                ];
            });
    }

    /**
     * Does this post contain a given shortcode?
     *
     * @param string $shortcode
     * @return bool
     */
    public function hasShortcode($shortcode)
    {
        return $this->shortcodes->contains(function ($sc) use ($shortcode) {
            return $sc['original'] == $shortcode;
        });
    }

    /**
     * Has this post been published?
     *
     * @return bool
     */
    public function hasBeenPublished()
    {
        return boolval($this->published_at);
    }

    /**
     * Scope a query to only include published posts.
     *
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function scopePublished($query)
    {
        return $query->whereNotNull('published_at');
    }

    /**
     * Has this post been updated since it was published?
     *
     * @return bool
     */
    public function hasBeenUpdatedAfterPublicationDate(): bool
    {
        if (is_null($this->published_at)) {
            return false;
        }

        return $this->updated_at->lt($this->published_at);
    }

    /**
     * Has it been more than a year since this post was published?
     *
     * @return bool
     */
    public function wasPublishedMoreThanAYearAgo(): bool
    {
        if (! $this->published_at) {
            return false;
        }

        return $this->published_at->lt(now()->subYear(1));
    }

    /**
     * Generate a string that presents the age of the post as a text sentence.
     *
     * @return string
     */
    public function publicationAgeForHumans()
    {
        $yearsOld = $this->published_at->diffInYears(now());

        if ($yearsOld < 1) {
            return '';
        }

        if ($yearsOld == 1) {
            return 'a year old;';
        }

        $numbers = [
            2 => 'two',
            3 => 'three',
            4 => 'four',
            5 => 'five',
            6 => 'six',
            7 => 'seven',
            8 => 'eight',
            9 => 'nine',
            10 => 'ten',
            11 => 'eleven',
            12 => 'twelve',
            13 => 'thirteen',
            14 => 'fourteen',
        ];

        return  Arr::get($numbers, $yearsOld, $yearsOld).' years old;';
    }

    /**
     * The url for this post.
     *
     * @return string
     */
    public function getUrlAttribute()
    {
        return route('blog.post', $this->slug);
    }

    /**
     * The one, or more, series that this post is associated with.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function series()
    {
        return $this->belongsToMany(Series::class)
            ->withPivot('sort_order');
    }
}
