<?php

namespace Tests\Feature\Backstage;

use App\Http\Livewire\Backstage\SeriesCreate;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SeriesCreationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_a_series()
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(SeriesCreate::class)
            ->set('name', 'New Series')
            ->set('description', 'New Series Description')
            ->call('store');

        $this->assertDatabaseHas('series', [
            'name' => 'New Series',
            'description' => 'New Series Description',
        ]);
    }

    /** @test */
    public function it_requires_a_name()
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(SeriesCreate::class)
            ->set('description', 'New Series Description')
            ->call('store');

        $this->assertDatabaseMissing('series', [
            'name' => 'New Series',
            'description' => 'New Series Description',
        ]);
    }
}
