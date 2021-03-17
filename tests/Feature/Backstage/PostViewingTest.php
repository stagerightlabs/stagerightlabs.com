<?php

namespace Tests\Feature\Backstage;

use App\Actions\Series\AddPostToSeriesAction;
use App\Http\Livewire\Backstage\PostShow;
use App\Post;
use App\Series;
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

    /** @test */
    public function a_post_can_be_added_to_a_series()
    {
        $this->actingAs(User::factory()->create());
        $series = Series::factory()->create();
        $post = Post::factory()->create();

        Livewire::test(PostShow::class, ['ref' => $post->reference_id])
            ->set('seriesIdToAdd', $series->id)
            ->call('addSeries');

        $series->posts()->pluck('id')->assertContains($post->id);
    }

    /** @test */
    public function a_post_can_be_removed_from_a_series()
    {
        $this->actingAs(User::factory()->create());
        $series = Series::factory()->create();
        $post = Post::factory()->create();
        AddPostToSeriesAction::execute([
            'post' => $post,
            'series' => $series,
        ]);

        Livewire::test(PostShow::class, ['ref' => $post->reference_id])
            ->call('removeSeries', $series->id);

        $series->posts()->pluck('id')->assertMissing($post->id);
    }
}
