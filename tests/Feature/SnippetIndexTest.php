<?php

namespace Tests\Feature;

use App\User;
use App\Snippet;
use Tests\TestCase;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

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
