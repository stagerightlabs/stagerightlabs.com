<?php

namespace Tests\Feature\Backstage;

use App\Http\Livewire\Backstage\SeriesUpdate;
use App\Series;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SeriesUpdatingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_update_series()
    {
        $series = Series::factory()->create();

        Livewire::test(SeriesUpdate::class, ['ref' => $series->reference_id])
            ->assertForbidden();
    }

    /** @test */
    public function users_can_update_posts()
    {
        $this->actingAs(User::factory()->create());
        $series = Series::factory()->create([
            'description' => 'Original description',
            'name' => 'Original name',
            'slug' => 'original-slug',
        ]);

        Livewire::test(SeriesUpdate::class, ['ref' => $series->reference_id])
            ->set('series.description', 'New description')
            ->set('series.name', 'New name')
            ->set('series.slug', 'new-slug')
            ->call('update');

        $this->assertDatabaseHas('series', [
            'description' => 'New description',
            'name' => 'New name',
            'reference_id' => $series->reference_id,
            'slug' => 'new-slug',
        ]);
    }

    /** @test */
    public function it_requires_a_name()
    {
        $this->actingAs(User::factory()->create());
        $series = Series::factory()->create([
            'description' => 'Original description',
            'name' => 'Original name',
        ]);

        Livewire::test(SeriesUpdate::class, ['ref' => $series->reference_id])
            ->set('series.description', 'New description')
            ->set('series.name', '')
            ->call('update')
            ->assertHasErrors('series.name');

        $this->assertDatabaseMissing('series', [
            'description' => 'New description',
            'name' => 'New name',
            'reference_id' => $series->reference_id,
        ]);
    }

    /** @test */
    public function it_requires_a_slug()
    {
        $this->actingAs(User::factory()->create());
        $series = Series::factory()->create([
            'description' => 'Original description',
            'name' => 'Original name',
            'slug' => 'original-slug',
        ]);

        Livewire::test(SeriesUpdate::class, ['ref' => $series->reference_id])
            ->set('series.description', 'New description')
            ->set('series.slug', '')
            ->call('update')
            ->assertHasErrors('series.slug');

        $this->assertDatabaseMissing('series', [
            'description' => 'New description',
            'reference_id' => $series->reference_id,
        ]);
    }
}
