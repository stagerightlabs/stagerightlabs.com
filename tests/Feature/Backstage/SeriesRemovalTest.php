<?php

namespace Tests\Feature\Backstage;

use App\Http\Livewire\Backstage\SeriesShow;
use App\Post;
use App\Series;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SeriesRemovalTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_remove_a_series()
    {
        $this->actingAs(User::factory()->create());
        $series = Series::factory()->create();

        Livewire::test(SeriesShow::class, ['ref' => $series->reference_id])
            ->call('remove');

        $this->assertDatabaseMissing('series', [
            'reference_id' => $series->reference_id,
        ]);
    }

    /** @test */
    public function a_user_cannot_remove_a_series_with_posts()
    {
        $this->actingAs(User::factory()->create());
        $series = Series::factory()
            ->hasAttached(
                Post::factory()->count(1),
                ['sort_order' => 1]
            )
            ->create();

        Livewire::test(SeriesShow::class, ['ref' => $series->reference_id])
            ->call('remove');

        $this->assertDatabaseHas('series', [
            'reference_id' => $series->reference_id,
        ]);
    }
}
