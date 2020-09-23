<?php

namespace Tests\Feature\Backstage;

use App\Http\Livewire\Backstage\PostIndex;
use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
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
        $this->actingAs(factory(User::class)->create());
        $post = factory(Post::class)->create();

        Livewire::test(PostIndex::class)
            ->assertSee($post->title);
    }
}
