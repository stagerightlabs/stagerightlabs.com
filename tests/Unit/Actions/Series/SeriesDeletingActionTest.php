<?php

namespace Tests\Unit\Actions\Series;

use App\Actions\Series\SeriesDeletingAction;
use App\Post;
use App\Series;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeriesDeletingActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_deletes_a_series()
    {
        $series = Series::factory()->create();

        $action = SeriesDeletingAction::execute([
            'series' => $series,
        ]);

        $this->assertTrue($action->completed());
        $this->assertDatabaseMissing('series', [
            'name' => $series->name,
        ]);
    }

    /** @test */
    public function it_requires_a_series()
    {
        $action = SeriesDeletingAction::execute();

        $this->assertFalse($action->completed());
    }

    /** @test */
    public function a_series_with_posts_cannot_be_deleted()
    {
        $series = Series::factory()
            ->hasAttached(
                Post::factory()->count(1),
                ['sort_order' => 1]
            )
            ->create();

        $action = SeriesDeletingAction::execute([
            'series' => $series,
        ]);

        $this->assertFalse($action->completed());
        $this->assertDatabaseHas('series', [
            'name' => $series->name,
        ]);
    }
}
