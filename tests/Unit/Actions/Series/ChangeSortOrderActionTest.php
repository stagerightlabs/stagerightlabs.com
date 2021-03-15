<?php

namespace Tests\Unit\Actions\Series;

use App\Actions\Series\AddPostToSeriesAction;
use App\Actions\Series\ChangeSortOrderAction;
use App\Post;
use App\Series;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ChangeSortOrderActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_a_series_sort_order()
    {
        $series = Series::factory()->create();
        Post::factory()->count(3)->create()
            ->each(function($post) use ($series) {
                AddPostToSeriesAction::execute([
                    'post' => $post,
                    'series' => $series,
                ]);
            });
        $posts = $series->posts;
        $postIds = $posts->pluck('id');
        $originalSortOrder = $posts->pluck('pivot.sort_order', 'id');
        $this->assertEquals(0, $originalSortOrder[$postIds[0]]);
        $this->assertEquals(1, $originalSortOrder[$postIds[1]]);
        $this->assertEquals(2, $originalSortOrder[$postIds[2]]);

        $action = ChangeSortOrderAction::execute([
            'order' => [
                $posts[0]->id => 2,
                $posts[2]->id => 1,
                $posts[1]->id => 0,
            ],
            'series' => $series,
        ]);

        $this->assertTrue($action->completed());
        $posts = $series->fresh()->posts;
        $newSortOrder = $posts->pluck('pivot.sort_order', 'id');
        $this->assertEquals(2, $newSortOrder[$postIds[0]]);
        $this->assertEquals(0, $newSortOrder[$postIds[1]]);
        $this->assertEquals(1, $newSortOrder[$postIds[2]]);
    }

    /** @test */
    public function it_requires_an_order()
    {
        $series = Series::factory()->create();
        $action = ChangeSortOrderAction::execute([
            'series' => $series,
        ]);

        $this->assertFalse($action->completed());
    }

    /** @test */
    public function it_requires_a_series()
    {
        $series = Series::factory()->create();
        Post::factory()->count(3)->create()
            ->each(function ($post) use ($series) {
                AddPostToSeriesAction::execute([
                    'post' => $post,
                    'series' => $series,
                ]);
            });
        $posts = $series->posts;

        $action = ChangeSortOrderAction::execute([
            'order' => [
                $posts[0]->id => 2,
                $posts[2]->id => 1,
                $posts[1]->id => 0,
            ],
        ]);

        $this->assertFalse($action->completed());
    }
}
