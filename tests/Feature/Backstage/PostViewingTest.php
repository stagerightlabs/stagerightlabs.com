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
        $post = Post::factory()->create();

        Livewire::test(PostShow::class, ['ref' => $post->reference_id])
            ->assertForbidden();
    }

    /** @test */
    public function users_can_view_posts_backstage()
    {
        $this->actingAs(User::factory()->create());
        $post = Post::factory()->create();

        Livewire::test(PostShow::class, ['ref' => $post->reference_id])
            ->assertSee($post->title);
    }
}
