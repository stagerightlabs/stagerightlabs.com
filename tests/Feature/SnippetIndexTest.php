<?php

namespace Tests\Feature;

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
        Livewire::test('backstage.snippet-index')
            ->assertForbidden();
    }

    /** @test */
    public function users_can_view_snippets()
    {
        $this->actingAs(factory(User::class)->create());
        $snippet = factory(Snippet::class)->create();

        Livewire::test('backstage.snippet-index')
            ->assertSee($snippet->name)
            ->assertSee($snippet->shortcode);
    }
}
