<?php

namespace Tests\Feature\Backstage;

use App\Http\Livewire\Backstage\SeriesIndex;
use App\Series;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SeriesIndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_view_the_series_management_index()
    {
        Livewire::test(SeriesIndex::class)
            ->assertForbidden();
    }

    /** @test */
    public function users_can_view_the_series_management_index()
    {
        $this->actingAs(User::factory()->create());
        $series = Series::factory()->create();

        Livewire::test(SeriesIndex::class)
            ->assertSee($series->title);
    }
}
