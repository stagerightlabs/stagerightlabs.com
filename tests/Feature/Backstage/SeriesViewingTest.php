<?php

namespace Tests\Feature\Backstage;

use App\Http\Livewire\Backstage\SeriesShow;
use App\Series;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SeriesViewingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_view_posts_backstage()
    {
        $series = Series::factory()->create();

        Livewire::test(SeriesShow::class, ['ref' => $series->reference_id])
            ->assertForbidden();
    }

    /** @test */
    public function users_can_view_posts_backstage()
    {
        $this->actingAs(User::factory()->create());
        $series = Series::factory()->create();

        Livewire::test(SeriesShow::class, ['ref' => $series->reference_id])
            ->assertSee($series->title);
    }
}
