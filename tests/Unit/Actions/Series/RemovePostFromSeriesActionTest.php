<?php

namespace Tests\Unit\Actions\Series;

use App\Actions\Series\AddPostToSeriesAction;
use App\Actions\Series\RemovePostFromSeriesAction;
use App\Post;
use App\Series;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class RemovePostFromSeriesActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_removes_a_post_from_a_series()
    {
        $post = Post::factory()->create();
        $series = Series::factory()->create();
        AddPostToSeriesAction::execute([
            'post' => $post,
            'series' => $series,
        ]);

        $action = RemovePostFromSeriesAction::execute([
            'post' => $post,
            'series' => $series,
        ]);

        $this->assertTrue($action->completed());
        $this->assertTrue($series->fresh()->posts->isEmpty());
    }

    /** @test */
    public function it_requires_a_post()
    {
        $series = Series::factory()->create();

        $action = RemovePostFromSeriesAction::execute([
            'series' => $series,
        ]);

        $this->assertFalse($action->completed());
    }

    /** @test */
    public function it_requires_a_series()
    {
        $post = Post::factory()->create();

        $action = RemovePostFromSeriesAction::execute([
            'post' => $post,
        ]);

        $this->assertFalse($action->completed());
    }
}
