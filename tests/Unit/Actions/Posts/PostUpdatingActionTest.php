<?php

namespace Tests\Unit\Actions\Posts;

use App\Actions\Posts\PostUpdatingAction;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostUpdatingActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_posts()
    {
        $author = User::factory()->create();
        $post = Post::factory()->create([
            'content' => 'Original Content',
            'description' => 'Original Description',
            'title' => 'Original Title',
            'slug' => 'original-title',
        ]);

        $action = (new PostUpdatingAction)->execute([
            'author' => $author,
            'content' => 'New Content',
            'description' => 'New Description',
            'post' => $post,
            'title' => 'New Title',
        ]);

        $this->assertTrue($action->completed());
        $this->assertEquals('New Content', $action->post->content);
        $this->assertEquals('New Description', $action->post->description);
        $this->assertEquals('original-title', $action->post->slug);
        $this->assertEquals('New Title', $action->post->title);
    }

    /** @test */
    public function it_updates_posts_with_tags()
    {
        $author = User::factory()->create();
        $post = Post::factory()->create([
            'content' => 'Original Content',
            'title' => 'Original Title',
            'slug' => 'original-title',
        ]);
        $tagA = Tag::factory()->create([
            'name' => 'Tag A',
        ]);
        $post->tags()->attach($tagA);
        $tagB = Tag::factory()->create([
            'name' => 'Tag B',
        ]);
        $tagC = Tag::factory()->create([
            'name' => 'Tag C',
        ]);

        $action = (new PostUpdatingAction)->execute([
            'author' => $author,
            'content' => 'New Content',
            'post' => $post,
            'tags' => collect([$tagB, $tagC])->pluck('slug')->toArray(),
            'title' => 'New Title',
            'slug' => 'new-slug',
        ]);

        $this->assertTrue($action->completed());
        $this->assertEquals('new-slug', $action->post->slug);
        $action->post->tags->assertMissing($tagA);
        $action->post->tags->assertContains($tagB);
        $action->post->tags->assertContains($tagC);
    }

    /** @test */
    public function it_requires_a_title()
    {
        $post = Post::factory()->create([
            'content' => 'Original Content',
            'title' => 'Original Title',
            'slug' => 'original-title',
        ]);

        $action = (new PostUpdatingAction)->execute([
            'content' => 'New Content',
            'post' => $post,
        ]);

        $this->assertFalse($action->completed());
    }

    /** @test */
    public function it_requires_content()
    {
        $post = Post::factory()->create([
            'content' => 'Original Content',
            'title' => 'Original Title',
            'slug' => 'original-title',
        ]);

        $action = (new PostUpdatingAction)->execute([
            'post' => $post,
            'title' => 'New Title',
        ]);

        $this->assertFalse($action->completed());
    }

    /** @test */
    public function it_requires_a_post()
    {
        $action = (new PostUpdatingAction)->execute([
            'content' => 'New Content',
            'title' => 'New Title',
        ]);

        $this->assertFalse($action->completed());
    }

    /** @test */
    public function it_publishes_posts()
    {
        $author = User::factory()->create();
        $post = Post::factory()->draft()->create([
            'content' => 'Original Content',
            'title' => 'Original Title',
            'slug' => 'original-title',
        ]);

        $action = (new PostUpdatingAction)->execute([
            'author' => $author,
            'content' => 'New Content',
            'post' => $post,
            'title' => 'New Title',
            'published_at' => '2020-01-01',
        ]);

        $this->assertTrue($action->completed());
        $this->assertNotNull($action->post->published_at);
    }

    /** @test */
    public function it_reverts_post_publication()
    {
        $author = User::factory()->create();
        $post = Post::factory()->published()->create([
            'content' => 'Original Content',
            'title' => 'Original Title',
            'slug' => 'original-title',
        ]);

        $action = (new PostUpdatingAction)->execute([
            'author' => $author,
            'content' => 'New Content',
            'post' => $post,
            'title' => 'New Title',
            'published_at' => null,
        ]);

        $this->assertTrue($action->completed());
        $this->assertNull($action->post->published_at);
    }
}
