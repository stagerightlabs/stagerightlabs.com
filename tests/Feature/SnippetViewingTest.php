<?php

namespace Tests\Feature;

use App\User;
use App\Snippet;
use Tests\TestCase;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SnippetViewingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_view_snippets()
    {
        $snippet = factory(Snippet::class)->create();

        Livewire::test('backstage.snippet-show', ['ref' => $snippet->reference_id])
            ->assertForbidden();
    }

    /** @test */
    public function users_can_view_snippets()
    {
        $this->actingAs(factory(User::class)->create());
        $snippet = factory(Snippet::class)->create();

        Livewire::test('backstage.snippet-show', ['ref' => $snippet->reference_id])
            ->assertSee($snippet->reference_id)
            ->assertSee($snippet->name)
            ->assertSee($snippet->shortcode);
    }
}
