<?php

namespace Tests\Feature\Backstage;

use App\Http\Livewire\Backstage\PostCreate;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PostCreationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_create_posts()
    {
        Livewire::test(PostCreate::class)
            ->assertForbidden();
    }

    /** @test */
    public function users_can_create_posts()
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(PostCreate::class)->dump()
            ->set('content', "This is the new\npost content.")
            ->set('description', 'This is a post description')
            ->set('title', 'A New Post')
            ->call('store');

        $this->assertSessionHasAlert('success');
        $this->assertDatabaseHas('posts', [
            'content' => "This is the new\npost content.",
            'description' => 'This is a post description',
            'title' => 'A New Post',
        ]);
    }

    /** @test */
    public function users_can_create_posts_with_tags()
    {
        $this->actingAs(User::factory()->create());
        $tags = Tag::factory()->count(2)->create();

        Livewire::test(PostCreate::class)->dump()
            ->set('content', "This is the new\npost content.")
            ->set('tags', $tags->pluck('slug')->toArray())
            ->set('title', 'A New Post')
            ->call('store');

        $post = Post::with('tags')->where('title', 'A New Post')->first();
        $tags->each(function ($tag) use ($post) {
            $post->tags->assertContains($tag);
        });
    }

    /** @test */
    public function it_requires_a_post_title()
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(PostCreate::class)->dump()
            ->set('content', "This is the new\npost content.")
            ->call('store')
            ->assertHasErrors('title');
    }

    /** @test */
    public function it_requires_post_content()
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(PostCreate::class)->dump()
            ->set('title', 'A New Post')
            ->call('store')
            ->assertHasErrors('content');
    }
}
