<?php

namespace Tests\Unit\Actions\Tags;

use App\Actions\Tags\TagDeletionAction;
use App\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class TagDeletionActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_deletes_tags()
    {
        $tag = factory(Tag::class)->create();

        $action = (new TagDeletionAction)->execute([
            'tag' => $tag,
        ]);

        $this->assertTrue($action->completed());
        $this->assertDatabaseMissing('tags', [
            'reference_id' => $tag->reference_id,
        ]);
    }

    /** @test */
    public function tags_associated_with_posts_cannot_be_deleted()
    {
        $this->markTestSkipped();
    }

    /** @test */
    public function it_requires_a_tag()
    {
        $action = (new TagDeletionAction)->execute();

        $this->assertFalse($action->completed());
    }
}
