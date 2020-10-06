<?php

namespace Tests\Feature\Backstage;

use App\Http\Livewire\Backstage\PostIndex;
use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PostIndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_view_the_post_management_index()
    {
        Livewire::test(PostIndex::class)
            ->assertForbidden();
    }

    /** @test */
    public function users_can_view_the_post_management_index()
    {
        $this->actingAs(User::factory()->create());
        $post = Post::factory()->create();

        Livewire::test(PostIndex::class)
            ->assertSee($post->title);
    }
}
