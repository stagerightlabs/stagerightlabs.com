<?php

namespace Tests\Unit\Actions\Snippets;

use App\Actions\Snippets\SnippetCreatingAction;
use App\Jobs\SnippetRenderingJob;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Bus;
use Tests\TestCase;

class SnippetCreatingActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_creates_snippets_with_minimal_fields()
    {
        Bus::fake();

        $action = SnippetCreatingAction::execute([
            'content' => 'This is some content',
            'name' => 'Snippet Name',
        ]);

        $this->assertTrue($action->completed());
        $this->assertInstanceOf(\App\Snippet::class, $action->snippet);
        $this->assertNotNull($action->snippet->id);
        $this->assertNotNull($action->snippet->reference_id);
        $this->assertEquals('This is some content', $action->snippet->content);
        $this->assertEquals('Snippet Name', $action->snippet->name);
        Bus::assertDispatched(function (SnippetRenderingJob $job) use ($action) {
            return $job->snippet->id === $action->snippet->id;
        });
    }

    /** @test */
    public function it_creates_snippets_with_all_fields()
    {
        Bus::fake();

        $action = SnippetCreatingAction::execute([
            'content' => 'This is some content',
            'filename' => 'example.sh',
            'language' => 'bash',
            'name' => 'Snippet Name',
            'starting_line' => 111,
            'url' => 'http://www.example.com',
        ]);

        $this->assertTrue($action->completed());
        $this->assertInstanceOf(\App\Snippet::class, $action->snippet);
        $this->assertNotNull($action->snippet->id);
        $this->assertNotNull($action->snippet->reference_id);
        $this->assertEquals('This is some content', $action->snippet->content);
        $this->assertEquals('example.sh', $action->snippet->filename);
        $this->assertEquals('bash', $action->snippet->language);
        $this->assertEquals('Snippet Name', $action->snippet->name);
        $this->assertEquals(111, $action->snippet->starting_line);
        $this->assertEquals('http://www.example.com', $action->snippet->url);
        Bus::assertDispatched(function (SnippetRenderingJob $job) use ($action) {
            return $job->snippet->id === $action->snippet->id;
        });
    }

    /** @test */
    public function it_requires_a_snippet_name()
    {
        $action = SnippetCreatingAction::execute([
            'content' => 'This is some content',
        ]);

        $this->assertFalse($action->completed());
    }

    /** @test */
    public function it_requires_snippet_content()
    {
        $action = SnippetCreatingAction::execute([
            'name' => 'Snippet Name',
        ]);

        $this->assertFalse($action->completed());
    }
}
