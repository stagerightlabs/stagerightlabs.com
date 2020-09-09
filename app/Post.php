<?php

namespace App;

use App\Concerns\ReferenceIds;
use App\Concerns\UuidAsPrimaryKey;
use App\Utilities\Str;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use UuidAsPrimaryKey, ReferenceIds;

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
        return 'PT' . Str::safeRandom(6);
    }

    /**
     * The tags associated with this post.
     *
     * @return \Illuminate\Database\Eloquent\Relations\MorphToMany
     */
    public function tags()
    {
        return $this->morphToMany(Tag::class, 'taggable');
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
            ->map(function($match) {
                return [
                    'original' => $match[0],
                    'offset' => $match[1],
                    'length' => strlen($match[0]),
                    'code' => str_replace(['[', ']'], '', $match[0])
                ];
            });
    }

    /**
     * Does this post contain a given shortcode?
     *
     * @param string $shortcode
     * @return boolean
     */
    public function hasShortcode($shortcode)
    {
        return $this->shortcodes->contains(function($sc) use ($shortcode) {
            return $sc['original'] == $shortcode;
        });
    }
}
