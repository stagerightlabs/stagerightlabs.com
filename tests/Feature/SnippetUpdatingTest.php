<?php

namespace Tests\Feature;

use App\User;
use App\Snippet;
use Tests\TestCase;
use Livewire\Livewire;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SnippetUpdatingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_edit_snippets()
    {
        $snippet = factory(Snippet::class)->create();

        Livewire::test('backstage.snippet-update', ['ref' => $snippet->reference_id])
            ->assertForbidden();
    }

    /** @test */
    public function users_can_update_snippets()
    {
        $this->actingAs(factory(User::class)->create());
        $snippet = factory(Snippet::class)->create([
            'content' => 'some interesting content',
            'name' => 'Test Snippet',
        ]);

        Livewire::test('backstage.snippet-update', ['ref' => $snippet->reference_id])
            ->set('content', 'Updated snippet content')
            ->set('name', 'New Name')
            ->call('update');

        $snippet = $snippet->refresh();
        $this->assertEquals('Updated snippet content', $snippet->content);
        $this->assertEquals('New Name', $snippet->name);
    }

    /** @test */
    public function users_can_update_snippet_meta_data()
    {
        $this->actingAs(factory(User::class)->create());
        $snippet = factory(Snippet::class)->create([
            'filename' => 'example.sh',
            'language' => 'bash',
            'content' => 'some interesting content',
            'name' => 'Test Snippet',
            'starting_line' => 22,
            'url' => 'http://example.com',
        ]);

        Livewire::test('backstage.snippet-update', ['ref' => $snippet->reference_id])
            ->set('filename', 'script.sh')
            ->set('language', 'shell')
            ->set('content', 'Updated snippet content')
            ->set('name', 'New Name')
            ->set('startingLineNumber', 33)
            ->set('url', 'http://example.org')
            ->call('update');

        $snippet = $snippet->refresh();
        $this->assertEquals('script.sh', $snippet->filename);
        $this->assertEquals('shell', $snippet->language);
        $this->assertEquals('Updated snippet content', $snippet->content);
        $this->assertEquals('New Name', $snippet->name);
        $this->assertEquals(33, $snippet->starting_line);
        $this->assertEquals('http://example.org', $snippet->url);
    }

    /** @test */
    public function it_requires_a_snippet_name()
    {
        $this->actingAs(factory(User::class)->create());
        $snippet = factory(Snippet::class)->create();

        Livewire::test('backstage.snippet-update', ['ref' => $snippet->reference_id])
            ->set('content', 'Updated snippet content')
            ->set('name', '')
            ->call('update')
            ->assertHasErrors('name');
    }

    /** @test */
    public function it_requires_snippet_content()
    {
        $this->actingAs(factory(User::class)->create());
        $snippet = factory(Snippet::class)->create();

        Livewire::test('backstage.snippet-update', ['ref' => $snippet->reference_id])
            ->set('content', '')
            ->set('name', 'New Name')
            ->call('update')
            ->assertHasErrors('content');
    }
}
