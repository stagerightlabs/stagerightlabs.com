<?php

namespace Tests\Unit\Actions\Tags;

use App\Actions\Tags\TagCreationAction;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagCreationActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_tags()
    {
        $action = (new TagCreationAction)->execute([
            'name' => 'Post Topic',
        ]);

        $this->assertTrue($action->completed());
        $this->assertNotNull($action->tag->reference_id);
        $this->assertDatabaseHas('tags', [
            'name' => 'Post Topic',
            'slug' => 'post-topic',
        ]);
    }

    /** @test */
    public function it_requires_a_tag_name()
    {
        $action = (new TagCreationAction)->execute();

        $this->assertFalse($action->completed());
    }
}
