<?php

namespace Tests\Unit\Actions;

use App\Actions\PostCreatingAction;
use App\Tag;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostCreatingActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_posts()
    {
        $author = factory(User::class)->create();

        $action = (new PostCreatingAction)->execute([
            'author' => $author,
            'content' => 'Some new content',
            'title' => 'A New Post',
        ]);

        $this->assertTrue($action->completed());
        $this->assertEquals('A New Post', $action->post->title);
        $this->assertEquals('a-new-post', $action->post->slug);
        $this->assertNull($action->post->published_at);
        $this->assertEquals($author->id, $action->post->author_id);
    }

    /** @test */
    public function it_creates_posts_with_tags()
    {
        $author = factory(User::class)->create();
        $tagA = factory(Tag::class)->create([
            'name' => 'Tag A',
        ]);
        $tagB = factory(Tag::class)->create([
            'name' => 'Tag B',
        ]);

        $action = (new PostCreatingAction)->execute([
            'author' => $author,
            'content' => 'Some new content',
            'tags' => collect([$tagA, $tagB])->pluck('slug')->toArray(),
            'title' => 'A New Post',
        ]);

        $this->assertTrue($action->completed());
        $action->post->tags->assertContains($tagA);
        $action->post->tags->assertContains($tagB);
    }

    /** @test */
    public function it_requires_a_title()
    {
        $action = (new PostCreatingAction)->execute([
            'content' => 'Some new content',
        ]);

        $this->assertFalse($action->completed());
    }

    /** @test */
    public function it_requires_content()
    {
        $action = (new PostCreatingAction)->execute([
            'title' => 'A New Post',
        ]);

        $this->assertFalse($action->completed());
    }
}
