<?php

namespace Tests\Unit\Actions\Posts;

use App\Actions\Posts\PostMarkdownRenderingAction;
use App\Actions\Snippets\SnippetRenderingAction;
use App\Post;
use App\Snippet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostMarkdownRenderingActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_converts_a_post_to_markdown()
    {
        $post = Post::factory()->create([
            'content' => '# New Post',
            'title' => 'New Post',
        ]);

        $action = PostMarkdownRenderingAction::execute([
            'post' => $post,
        ]);

        $this->assertTrue($action->completed());
        $this->assertStringContainsString('# New Post', $action->rendered);
    }

    /** @test */
    public function it_embeds_snippet_html_into_markdown()
    {
        $snippetA = Snippet::factory()->create([
            'content' => 'this is the first snippet',
        ]);
        $snippetA = $this->renderSnippet($snippetA);
        $snippetB = Snippet::factory()->create([
            'content' => 'this is the second snippet',
        ]);
        $snippetB = $this->renderSnippet($snippetB);

        $post = Post::factory()->create([
            'content' => "# New Post\n\n {$snippetA->shortcode} \n\n {$snippetB->shortcode}",
            'title' => 'New Post',
        ]);

        $action = PostMarkdownRenderingAction::execute([
            'post' => $post,
        ]);

        $this->assertTrue($post->hasShortcode($snippetA->shortcode));
        $this->assertTrue($post->hasShortcode($snippetB->shortcode));
        $this->assertStringContainsString('# New Post', $action->rendered);
        $this->assertStringNotContainsString($snippetA->shortcode, $action->rendered);
        $this->assertStringContainsString($snippetA->rendered, $action->rendered);
        $this->assertStringNotContainsString($snippetB->shortcode, $action->rendered);
        $this->assertStringContainsString($snippetB->rendered, $action->rendered);
    }

    /** @test */
    public function it_requires_a_post()
    {
        $action = PostMarkdownRenderingAction::execute();

        $this->assertFalse($action->completed());
    }

    protected function renderSnippet($snippet)
    {
        $action = SnippetRenderingAction::execute([
            'snippet' => $snippet,
            'cascade' => false,
        ]);

        $snippet->rendered = $action->rendered;
        $snippet->save();

        return $snippet;
    }
}
