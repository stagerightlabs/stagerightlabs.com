<?php

namespace Tests\Feature\Backstage;

use App\Http\Livewire\Backstage\PostShow;
use App\Post;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class PostRemovalTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function users_can_remove_draft_posts()
    {
        $this->actingAs(User::factory()->create());
        $post = Post::factory()->draft()->create();

        Livewire::test(PostShow::class, ['ref' => $post->reference_id])
            ->call('delete');

        $this->assertDatabaseMissing('posts', [
            'reference_id' => $post->reference_id,
        ]);
    }

    /** @test */
    public function users_cannot_remove_published_posts()
    {
        $this->actingAs(User::factory()->create());
        $post = Post::factory()->published()->create();

        Livewire::test(PostShow::class, ['ref' => $post->reference_id])
            ->call('delete');

        $this->assertDatabaseHas('posts', [
            'reference_id' => $post->reference_id,
        ]);
    }
}
