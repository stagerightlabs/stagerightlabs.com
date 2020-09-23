<?php

namespace Tests\Feature\Backstage;

use App\Http\Livewire\Backstage\PostUpdate;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Livewire\Livewire;
use Tests\TestCase;

class PostUpdatingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_update_posts()
    {
        $post = factory(Post::class)->create();

        Livewire::test(PostUpdate::class, ['ref' => $post->reference_id])
            ->assertForbidden();
    }

    /** @test */
    public function users_can_update_posts()
    {
        $this->actingAs(factory(User::class)->create());
        $post = factory(Post::class)->create([
            'content' => 'Original content',
            'description' => 'Original description',
            'title' => 'Original Title',
        ]);

        Livewire::test(PostUpdate::class, ['ref' => $post->reference_id])
            ->set('content', 'New content')
            ->set('description', 'New description')
            ->set('title', 'New Title')
            ->call('update');

        $this->assertDatabaseHas('posts', [
            'reference_id' => $post->reference_id,
            'content' => 'New content',
            'description' => 'New description',
            'title' => 'New Title',
        ]);
    }

    /** @test */
    public function users_can_update_a_post_with_tags()
    {
        $this->actingAs(factory(User::class)->create());
        $post = factory(Post::class)->create([
            'content' => 'Original content',
            'title' => 'Original Title',
        ]);
        $tags = factory(Tag::class, 2)->create();

        Livewire::test(PostUpdate::class, ['ref' => $post->reference_id])->dump()
            ->set('content', "New content")
            ->set('tags', $tags->pluck('slug')->toArray())
            ->set('title', 'New Title')
            ->call('update');

        $this->assertDatabaseHas('posts', [
            'reference_id' => $post->reference_id,
            'content' => 'New content',
            'title' => 'New Title',
        ]);
        $tags->each(function ($tag) use ($post) {
            $post->tags->assertContains($tag);
        });
    }

    /** @test */
    public function it_sets_a_publication_date()
    {
        $this->actingAs(factory(User::class)->create());
        $post = factory(Post::class)->state('draft')->create([
            'content' => 'Original content',
            'title' => 'Original Title',
        ]);

        Livewire::test(PostUpdate::class, ['ref' => $post->reference_id])
            ->set('publishedAt', '2020-01-01')
            ->call('update');

        $this->assertNotNull($post->fresh()->published_at);
    }

    /** @test */
    public function it_removes_a_publication_date()
    {
        $this->actingAs(factory(User::class)->create());
        $post = factory(Post::class)->state('published')->create([
            'content' => 'Original content',
            'title' => 'Original Title',
        ]);

        Livewire::test(PostUpdate::class, ['ref' => $post->reference_id])
            ->set('publishedAt', '')
            ->call('update');

        $this->assertNull($post->fresh()->published_at);
    }
}
