<?php

namespace Tests\Unit\Actions\Tags;

use App\Actions\Tags\TagUpdatingAction;
use App\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagUpdatingActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_a_tag()
    {
        $tag = Tag::factory()->create([
            'name' => 'Old Name',
            'slug' => 'old-name',
        ]);

        $action = TagUpdatingAction::execute([
            'tag' => $tag,
            'name' => 'New Name',
        ]);

        $tag = $tag->refresh();
        $this->assertTrue($action->completed());
        $this->assertEquals('New Name', $tag->name);
        $this->assertEquals('old-name', $tag->slug);
    }

    /** @test */
    public function it_requires_a_tag()
    {
        $action = TagUpdatingAction::execute([
            'name' => 'New Name',
        ]);

        $this->assertFalse($action->completed());
    }

    /** @test */
    public function it_requires_a_tag_name()
    {
        $tag = Tag::factory()->create([
            'name' => 'Old Name',
            'slug' => 'old-name',
        ]);

        $action = TagUpdatingAction::execute([
            'tag' => $tag,
        ]);

        $this->assertFalse($action->completed());
    }
}
