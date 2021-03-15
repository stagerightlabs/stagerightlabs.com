<?php

namespace Tests\Unit\Actions\Series;

use App\Actions\Series\SeriesCreatingAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SeriesCreatingActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_series()
    {
        $action = SeriesCreatingAction::execute([
            'name' => 'Test Series',
        ]);

        $this->assertTrue($action->completed());
        $this->assertEquals($action->series->name, 'Test Series');
        $this->assertNotNull($action->series->reference_id);
    }

    /** @test */
    public function it_creates_a_series_with_a_description()
    {
        $action = SeriesCreatingAction::execute([
            'description' => 'This is a description',
            'name' => 'Test Series',
        ]);

        $this->assertTrue($action->completed());
        $this->assertEquals($action->series->description, 'This is a description');
        $this->assertEquals($action->series->name, 'Test Series');
        $this->assertNotNull($action->series->reference_id);
    }

    /** @test */
    public function it_requires_a_name()
    {
        $action = SeriesCreatingAction::execute();

        $this->assertFalse($action->completed());
    }
}
