<?php

namespace Tests\Unit\Actions\Snippets;

use App\Actions\Snippets\SnippetRenderingAction;
use App\Snippet;
use Tests\TestCase;

class SnippetRenderingActionTest extends TestCase
{
    /** @test */
    public function it_renders_snippet_content_as_html()
    {
        $snippet = factory(Snippet::class)->make([
            'name' => 'Test Snippet',
            'content' => "This is some content.\n There are two lines.",
        ]);

        $action = (new SnippetRenderingAction)->execute([
            'snippet' => $snippet,
        ]);

        $this->assertTrue($action->completed());
        $this->assertStringContainsString('This is some content.', $action->rendered);
        $this->assertStringContainsString(SnippetRenderingAction::HTML_START, $action->rendered);
        $this->assertStringContainsString(SnippetRenderingAction::HTML_END, $action->rendered);
    }
}
