<?php

namespace Tests\Unit\Actions\Series;

use App\Actions\Series\SeriesUpdatingAction;
use App\Series;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeriesUpdatingActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_a_series()
    {
        $series = Series::factory()->create([
            'name' => 'Original Name',
            'description' => 'Original Description',
            'slug' => 'original-slug',
        ]);

        $action = SeriesUpdatingAction::execute([
            'description' => 'New description',
            'name' => 'New name',
            'series' => $series,
            'slug' => 'new-slug',
        ]);

        $this->assertTrue($action->completed());
        $this->assertEquals($action->series->description, 'New description');
        $this->assertEquals($action->series->name, 'New name');
        $this->assertEquals($action->series->slug, 'new-slug');
    }

    /** @test */
    public function it_requires_a_series()
    {
        $action = SeriesUpdatingAction::execute([
            'name' => 'New name',
            'description' => 'New description',
        ]);

        $this->assertFalse($action->completed());
    }

    /** @test */
    public function it_requires_a_name()
    {
        $series = Series::factory()->create([
            'name' => 'Original Name',
            'description' => 'Original Description',
        ]);

        $action = SeriesUpdatingAction::execute([
            'series' => $series,
            'description' => 'New description',
        ]);

        $this->assertFalse($action->completed());
    }
}
