<?php

namespace Tests\Unit\Actions\Series;

use App\Actions\Series\AddPostToSeriesAction;
use App\Post;
use App\Series;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class AddPostToSeriesActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_adds_a_post_to_a_series()
    {
        $post = Post::factory()->create();
        $series = Series::factory()->create();

        $action = AddPostToSeriesAction::execute([
            'post' => $post,
            'series' => $series,
        ]);

        $this->assertTrue($action->completed());
        $action->series->posts()->pluck('id')->assertContains($post->id);
        $this->assertEquals(0, $action->series->posts()->first()->pivot->sort_order);
    }

    /** @test */
    public function it_adds_a_post_with_an_appropriate_sort_order()
    {
        $post = Post::factory()->create();
        $series = Series::factory()
            ->hasAttached(
                Post::factory()->count(1),
                ['sort_order' => 1]
            )
            ->create();

        $action = AddPostToSeriesAction::execute([
            'post' => $post,
            'series' => $series,
        ]);

        $this->assertTrue($action->completed());
        $action->series->posts()->pluck('id')->assertContains($post->id);
        $this->assertCount(2, $action->series->posts);
        $this->assertEquals(1, $action->series->posts()->first()->pivot->sort_order);
    }

    /** @test */
    public function it_requires_a_post()
    {
        $series = Series::factory()->create();

        $action = AddPostToSeriesAction::execute([
            'series' => $series,
        ]);

        $this->assertFalse($action->completed());
    }

    /** @test */
    public function it_requires_a_series()
    {
        $post = Post::factory()->create();

        $action = AddPostToSeriesAction::execute([
            'post' => $post,
        ]);

        $this->assertFalse($action->completed());
    }
}
