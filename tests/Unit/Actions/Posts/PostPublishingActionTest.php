<?php

namespace Tests\Unit\Actions\Posts;

use App\Actions\Posts\PostPublishingAction;
use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostPublishingActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_publishes_a_post()
    {
        $post = factory(Post::class)->create([
            'published_at' => null,
        ]);

        $action = (new PostPublishingAction)->execute([
            'post' => $post,
        ]);

        $this->assertTrue($action->completed());
        $this->assertNotNull($action->post->published_at);
    }

    /** @test */
    public function it_requires_a_post()
    {
        $action = (new PostPublishingAction)->execute();

        $this->assertFalse($action->completed());
    }
}
