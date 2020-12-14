<?php

namespace App;

use App\Concerns\ReferenceIds;
use App\Concerns\UuidAsPrimaryKey;
use App\Utilities\Str;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Snippet extends Model
{
    use HasFactory, ReferenceIds, UuidAsPrimaryKey;

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'snippets';

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
        return 'SN'.Str::safeRandom(6);
    }

    /**
     * The "shortcode" used to reference this snippet in a blog post.
     *
     * @return string
     */
    public function getShortcodeAttribute()
    {
        return "[[Snippet {$this->reference_id}]]";
    }

    /**
     * Retrieve the blog posts that reference this snippet.
     *
     * @return Collection
     */
    public function getPostsThatUseThisSnippet()
    {
        return Post::where('content', 'LIKE', "%{$this->shortcode}%")->get();
    }
}
