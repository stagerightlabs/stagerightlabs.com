<?php

namespace Tests\Unit\Actions\Snippets;

use App\Actions\Snippets\SnippetUpdateAction;
use App\Snippet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SnippetUpdateActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_updates_snippets()
    {
        $snippet = factory(Snippet::class)->create([
            'content' => 'This is some content.',
            'filename' => 'script.sh',
            'language' => 'bash',
            'name' => 'Test Snippet',
            'starting_line' => 1,
            'url' => 'http://www.example.com',
        ]);

        $action = (new SnippetUpdateAction)->execute([
            'content' => 'Some new content',
            'filename' => 'example.sh',
            'language' => 'shell',
            'name' => 'Revised Name',
            'snippet' => $snippet,
            'starting_line' => 2,
            'url' => 'http://www.example.org',
        ]);

        $this->assertTrue($action->completed());
        $this->assertEquals($snippet->id, $action->snippet->id);
        $this->assertEquals($snippet->reference_id, $action->snippet->reference_id);
        $this->assertEquals('Some new content', $action->snippet->content);
        $this->assertEquals('example.sh', $action->snippet->filename);
        $this->assertEquals('shell', $action->snippet->language);
        $this->assertEquals('Revised Name', $action->snippet->name);
        $this->assertEquals(2, $action->snippet->starting_line);
        $this->assertEquals('http://www.example.org', $action->snippet->url);
    }

    /** @test */
    public function it_requires_a_snippet()
    {
        $action = (new SnippetUpdateAction)->execute([
            'content' => 'Some new content',
            'name' => 'Revised Name',
        ]);

        $this->assertFalse($action->completed());
    }

    /** @test */
    public function it_requires_a_snippet_name()
    {
        $snippet = factory(Snippet::class)->create([
            'content' => 'This is some content.',
            'name' => 'Test Snippet',
        ]);

        $action = (new SnippetUpdateAction)->execute([
            'content' => 'Some new content',
            'snippet' => $snippet,
        ]);

        $this->assertFalse($action->completed());
    }

    /** @test */
    public function it_requires_snippet_content()
    {
        $snippet = factory(Snippet::class)->create([
            'content' => 'This is some content.',
            'name' => 'Test Snippet',
        ]);

        $action = (new SnippetUpdateAction)->execute([
            'name' => 'Test Snippet',
            'snippet' => $snippet,
        ]);

        $this->assertFalse($action->completed());
    }
}
