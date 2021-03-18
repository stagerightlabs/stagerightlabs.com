<?php

namespace Tests\Feature\Livewire;

use App\Actions\Series\AddPostToSeriesAction;
use App\Http\Livewire\PublicSeriesIndex;
use App\Post;
use App\Series;
use Livewire\Livewire;
use Tests\TestCase;

class PublicSeriesIndexTest extends TestCase
{
    /** @test */
    public function the_component_can_render()
    {
        $series = Series::factory()->create();
        $post = Post::factory()->published()->create();
        AddPostToSeriesAction::execute([
            'post' => $post,
            'series' => $series,
        ]);

        $component = Livewire::test(PublicSeriesIndex::class);

        $component->assertStatus(200);
        $component->assertSee($series->name);
    }

    /** @test */
    public function it_does_not_display_series_with_unpublished_posts()
    {
        $series = Series::factory()->create();
        $post = Post::factory()->draft()->create();
        AddPostToSeriesAction::execute([
            'post' => $post,
            'series' => $series,
        ]);

        $component = Livewire::test(PublicSeriesIndex::class);

        $component->assertStatus(200);
        $component->assertDontSee($series->name);
    }
}
