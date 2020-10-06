<?php

namespace Tests\Feature\Backstage;

use App\Http\Livewire\Backstage\SnippetCreate;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class SnippetCreationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_create_a_snippet()
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(SnippetCreate::class)
            ->set('content', "This is two lines\n of content.")
            ->set('name', 'New Snippet')
            ->call('store');

        $this->assertDatabaseHas('snippets', [
            'content' => "This is two lines\n of content.",
            'name' => 'New Snippet',
        ]);
    }

    /** @test */
    public function a_user_can_create_a_snippet_with_meta_data()
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(SnippetCreate::class)
            ->set('filename', 'example.sh')
            ->set('language', 'bash')
            ->set('content', "This is two lines\n of content.")
            ->set('name', 'New Snippet')
            ->set('startingLineNumber', 22)
            ->set('url', 'http://example.com')
            ->call('store');

        $this->assertDatabaseHas('snippets', [
            'filename' => 'example.sh',
            'language' => 'bash',
            'content' => "This is two lines\n of content.",
            'name' => 'New Snippet',
            'starting_line' => 22,
            'url' => 'http://example.com',
        ]);
    }

    /** @test */
    public function it_requires_a_snippet_name()
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(SnippetCreate::class)
            ->set('content', "This is two lines\n of content.")
            ->call('store')
            ->assertHasErrors('name');

        $this->assertDatabaseMissing('snippets', [
            'content' => "This is two lines\n of content.",
        ]);
    }

    /** @test */
    public function it_requires_snippet_content()
    {
        $this->actingAs(User::factory()->create());

        Livewire::test(SnippetCreate::class)
            ->set('name', 'New Snippet')
            ->call('store')
            ->assertHasErrors('content');

        $this->assertDatabaseMissing('snippets', [
            'name' => 'New Snippet',
        ]);
    }
}
