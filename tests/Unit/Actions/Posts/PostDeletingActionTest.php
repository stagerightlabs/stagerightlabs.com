<?php

namespace Tests\Unit\Actions\Posts;

use App\Actions\Posts\PostDeletingAction;
use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostDeletingActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_deletes_a_post()
    {
        $post = factory(Post::class)->create();

        $action = (new PostDeletingAction)->execute([
            'post' => $post,
        ]);

        $this->assertTrue($action->completed());
        $this->assertDatabaseMissing('posts', [
            'reference_id' => $post->reference_id,
        ]);
    }

    /** @test */
    public function it_requires_a_post()
    {
        $action = (new PostDeletingAction)->execute();

        $this->assertFalse($action->completed());
    }
}
