<?php

namespace Tests\Feature\Livewire;

use App\Actions\Series\AddPostToSeriesAction;
use App\Http\Livewire\PublicSeriesShow;
use App\Post;
use App\Series;
use Livewire\Livewire;
use Tests\TestCase;

class PublicSeriesShowTest extends TestCase
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

        $component = Livewire::test(PublicSeriesShow::class, ['slug' => $series->slug]);

        $component->assertStatus(200);
        $component->assertSee($series->name);
    }

    /** @test */
    public function it_will_not_show_a_series_with_no_published_posts()
    {
        $series = Series::factory()->create();
        $post = Post::factory()->draft()->create();
        AddPostToSeriesAction::execute([
            'post' => $post,
            'series' => $series,
        ]);

        $component = Livewire::test(PublicSeriesShow::class, ['slug' => $series->slug]);

        $component->assertNotFound();
    }
}
