<?php

namespace Tests\Feature\Backstage;

use App\Http\Livewire\Backstage\PostShow;
use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PostViewingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_view_posts_backstage()
    {
        $post = factory(Post::class)->create();

        Livewire::test(PostShow::class, ['ref' => $post->reference_id])
            ->assertForbidden();
    }

    /** @test */
    public function users_can_view_posts_backstage()
    {
        $this->actingAs(factory(User::class)->create());
        $post = factory(Post::class)->create();

        Livewire::test(PostShow::class, ['ref' => $post->reference_id])
            ->assertSee($post->title);
    }
}
