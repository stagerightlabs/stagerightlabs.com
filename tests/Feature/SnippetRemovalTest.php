<?php

namespace Tests\Feature;

use App\User;
use App\Snippet;
use Tests\TestCase;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SnippetRemovalTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function users_can_remove_snippets()
    {
        $this->actingAs(factory(User::class)->create());
        $snippet = factory(Snippet::class)->create();

        Livewire::test('backstage.snippet-show', ['ref' => $snippet->reference_id])
            ->call('remove')
            ->assertRedirect(route('backstage.snippets.index'));

        $this->assertDatabaseMissing('snippets', [
            'reference_id' => $snippet->reference_id,
        ]);
    }
}
