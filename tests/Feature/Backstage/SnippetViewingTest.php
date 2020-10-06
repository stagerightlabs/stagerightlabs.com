<?php

namespace Tests\Feature\Backstage;

use App\Http\Livewire\Backstage\SnippetShow;
use App\Snippet;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SnippetViewingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_view_snippets()
    {
        $snippet = Snippet::factory()->create();

        Livewire::test(SnippetShow::class, ['ref' => $snippet->reference_id])
            ->assertForbidden();
    }

    /** @test */
    public function users_can_view_snippets()
    {
        $this->actingAs(User::factory()->create());
        $snippet = Snippet::factory()->create();

        Livewire::test(SnippetShow::class, ['ref' => $snippet->reference_id])
            ->assertSee($snippet->reference_id)
            ->assertSee($snippet->name)
            ->assertSee($snippet->shortcode);
    }
}
