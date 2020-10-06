<?php

namespace Tests\Feature\Backstage;

use App\Http\Livewire\Backstage\SnippetShow;
use App\Snippet;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SnippetRemovalTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function users_can_remove_snippets()
    {
        $this->actingAs(User::factory()->create());
        $snippet = Snippet::factory()->create();

        Livewire::test(SnippetShow::class, ['ref' => $snippet->reference_id])
            ->call('remove')
            ->assertRedirect(route('backstage.snippets.index'));

        $this->assertDatabaseMissing('snippets', [
            'reference_id' => $snippet->reference_id,
        ]);
    }
}
