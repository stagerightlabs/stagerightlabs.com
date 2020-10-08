<?php

namespace App\Jobs;

use App\Actions\Snippets\SnippetRenderingAction;
use App\Snippet;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SnippetRenderingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The snippet to be rendered.
     *
     * @var Snippet
     */
    public $snippet;

    /**
     * Should we render the associated posts as well?
     *
     * @var bool
     */
    public $cascade;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Snippet $snippet, $cascade = true)
    {
        $this->snippet = $snippet;
        $this->cascade = $cascade;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $rendering = (new SnippetRenderingAction)->execute([
            'snippet' => $this->snippet,
            'cascade' => $this->cascade,
        ]);

        if ($rendering->completed()) {
            $this->snippet->rendered = $rendering->rendered;
        } else {
            $this->snippet->rendered = '';
        }

        $this->snippet->save();
    }
}
