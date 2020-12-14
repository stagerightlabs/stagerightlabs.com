<?php

namespace App\Jobs;

use App\Actions\Posts\PostHtmlRenderingAction;
use App\Post;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PostRenderingJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * The post that will be rendered.
     *
     * @var Post
     */
    public $post;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $rendering = PostHtmlRenderingAction::execute([
            'post' => $this->post,
        ]);

        if ($rendering->completed()) {
            $this->post->rendered = $rendering->rendered;
        } else {
            $this->post->rendered = '';
        }

        $this->post->save();
    }
}
