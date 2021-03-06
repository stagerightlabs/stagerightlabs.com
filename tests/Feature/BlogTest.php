<?php

namespace Tests\Feature;

use App\Post;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function the_blog_is_reachable()
    {
        $post = Post::factory()->published()->create();

        $response = $this->get('/');

        $response->assertSee($post->title);
    }
}
