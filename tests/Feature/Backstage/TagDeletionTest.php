<?php

namespace Tests\Feature\Backstage;

use App\Actions\Posts\PostUpdatingAction;
use App\Http\Livewire\Backstage\TagIndex;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class TagDeletionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function users_can_remove_unassigned_tags()
    {
        $this->actingAs(User::factory()->create());
        $tag = Tag::factory()->create();

        Livewire::test(TagIndex::class)
            ->call('remove', $tag->reference_id);

        $this->assertDatabaseMissing('tags', [
            'reference_id' => $tag->reference_id,
        ]);
    }

    /** @test */
    public function users_cannot_delete_tags_assigned_to_posts()
    {
        $this->actingAs(User::factory()->create());
        $post = Post::factory()->create();
        $tag = Tag::factory()->create();
        (new PostUpdatingAction)->execute([
            'content' => $post->content,
            'post' => $post,
            'tags' => [$tag->slug],
            'title' => $post->title,
        ]);

        Livewire::test(TagIndex::class)
            ->call('remove', $tag->reference_id)
            ->assertHasAlertMessage('error');

        $this->assertDatabaseHas('tags', [
            'reference_id' => $tag->reference_id,
        ]);
    }
}
