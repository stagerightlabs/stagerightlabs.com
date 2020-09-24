<?php

namespace Tests\Unit\Actions\Posts;

use App\Actions\Posts\PostTaggingAction;
use App\Post;
use App\Tag;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostTaggingActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_syncs_tags_with_posts()
    {
        $post = factory(Post::class)->create();
        $tags = factory(Tag::class, 2)->create();

        $tags->each(function ($tag) use ($post) {
            $post->tags->assertMissing($tag);
        });

        $action = (new PostTaggingAction)->execute([
            'post' => $post,
            'tags' => $tags,
        ]);

        $this->assertTrue($action->completed());
        $tags->each(function ($tag) use ($post) {
            $post->tags->assertContains($tag);
        });
    }

    /** @test */
    public function it_requires_a_post()
    {
        $action = (new PostTaggingAction)->execute();

        $this->assertFalse($action->completed());
    }

    /** @test */
    public function it_accepts_an_array_of_tag_models()
    {
        $post = factory(Post::class)->create();
        $tags = factory(Tag::class, 2)->create();

        $tags->each(function ($tag) use ($post) {
            $post->tags->assertMissing($tag);
        });

        $action = (new PostTaggingAction)->execute([
            'post' => $post,
            'tags' => [$tags[0], $tags[1]],
        ]);

        $this->assertTrue($action->completed());
        $tags->each(function ($tag) use ($post) {
            $post->tags->assertContains($tag);
        });
    }

    /** @test */
    public function it_accepts_an_array_of_tag_slugs()
    {
        $post = factory(Post::class)->create();
        $tags = factory(Tag::class, 2)->create();

        $tags->each(function ($tag) use ($post) {
            $post->tags->assertMissing($tag);
        });

        $action = (new PostTaggingAction)->execute([
            'post' => $post,
            'tags' => [$tags[0]->slug, $tags[1]->slug],
        ]);

        $this->assertTrue($action->completed());
        $tags->each(function ($tag) use ($post) {
            $post->tags->assertContains($tag);
        });
    }

    /** @test */
    public function it_accepts_a_collection_of_tag_slugs()
    {
        $post = factory(Post::class)->create();
        $tags = factory(Tag::class, 2)->create();

        $tags->each(function ($tag) use ($post) {
            $post->tags->assertMissing($tag);
        });

        $action = (new PostTaggingAction)->execute([
            'post' => $post,
            'tags' => $tags->pluck('slug'),
        ]);

        $this->assertTrue($action->completed());
        $tags->each(function ($tag) use ($post) {
            $post->tags->assertContains($tag);
        });
    }

    /** @test */
    public function it_accepts_a_single_tag_model()
    {
        $post = factory(Post::class)->create();
        $tag = factory(Tag::class)->create();

        $post->tags->assertMissing($tag);

        $action = (new PostTaggingAction)->execute([
            'post' => $post,
            'tags' => $tag,
        ]);

        $this->assertTrue($action->completed());
        $post->tags->assertContains($tag);
    }

    /** @test */
    public function it_accepts_a_single_tag_slug()
    {
        $post = factory(Post::class)->create();
        $tag = factory(Tag::class)->create();

        $post->tags->assertMissing($tag);

        $action = (new PostTaggingAction)->execute([
            'post' => $post,
            'tags' => $tag->slug,
        ]);

        $this->assertTrue($action->completed());
        $post->tags->assertContains($tag);
    }
}
