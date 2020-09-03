<?php

namespace App;

use App\Utilities\Str;
use App\Concerns\Checksums;
use App\Concerns\ReferenceIds;
use App\Concerns\UuidAsPrimaryKey;
use App\Events\SnippetCreating;
use App\Events\SnippetUpdating;
use Illuminate\Database\Eloquent\Model;

class Snippet extends Model
{
    use ReferenceIds, UuidAsPrimaryKey;

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        // Render the snippet HTML when saving
        static::saving(function ($snippet) {
            $action = (new \App\Actions\Snippets\SnippetRenderingAction)->execute([
                'snippet' => $snippet,
            ]);

            $snippet->rendered = $action->completed()
                ? $action->rendered
                : $snippet->rendered;
        });
    }



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
        return 'SN' . Str::safeRandom(6);
    }

    /**
     * The "shortcode" used to reference this snippet in a blog post.
     *
     * @return string
     */
    public function getShortcodeAttribute()
    {
        return "[Snippet {$this->reference_id}]";
    }
}
