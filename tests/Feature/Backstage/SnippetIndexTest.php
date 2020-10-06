<?php

namespace Tests\Feature\Backstage;

use App\Http\Livewire\Backstage\SnippetIndex;
use App\Snippet;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SnippetIndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_view_snippets()
    {
        Livewire::test(SnippetIndex::class)
            ->assertForbidden();
    }

    /** @test */
    public function users_can_view_snippets()
    {
        $this->actingAs(User::factory()->create());
        $snippet = Snippet::factory()->create();

        Livewire::test(SnippetIndex::class)
            ->assertSee($snippet->name)
            ->assertSee($snippet->shortcode);
    }
}
