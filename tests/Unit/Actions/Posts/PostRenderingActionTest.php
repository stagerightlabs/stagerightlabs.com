<?php

namespace Tests\Unit\Actions\Posts;

use App\Actions\Posts\PostRenderingAction;
use App\Actions\Snippets\SnippetRenderingAction;
use App\Post;
use App\Snippet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PostRenderingActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_converts_post_markdown_to_html()
    {
        $post = Post::factory()->create([
            'content' => '# New Post',
            'title' => 'New Post',
        ]);

        $action = (new PostRenderingAction)->execute([
            'post' => $post,
        ]);

        $this->assertTrue($action->completed());
        $this->assertStringContainsString('<h1>New Post</h1>', $action->rendered);
    }

    /** @test */
    public function it_converts_snippet_short_codes_to_html()
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

        $action = (new PostRenderingAction)->execute([
            'post' => $post,
        ]);

        $this->assertTrue($post->hasShortcode($snippetA->shortcode));
        $this->assertTrue($post->hasShortcode($snippetB->shortcode));
        $this->assertStringContainsString('<h1>New Post</h1>', $action->rendered);
        $this->assertStringNotContainsString($snippetA->shortcode, $action->rendered);
        $this->assertStringContainsString($snippetA->rendered, $action->rendered);
        $this->assertStringNotContainsString($snippetB->shortcode, $action->rendered);
        $this->assertStringContainsString($snippetB->rendered, $action->rendered);
    }

    /** @test */
    public function it_requires_a_post()
    {
        $action = (new PostRenderingAction)->execute();

        $this->assertFalse($action->completed());
    }

    protected function renderSnippet($snippet)
    {
        $action = (new SnippetRenderingAction)->execute([
            'snippet' => $snippet,
            'cascade' => false,
        ]);

        $snippet->rendered = $action->rendered;
        $snippet->save();

        return $snippet;
    }
}
