<?php

namespace Tests\Unit\Actions\Snippets;

use App\Actions\Snippets\SnippetDeletionAction;
use App\Snippet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SnippetDeletionActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_removes_snippets_from_the_database()
    {
        $snippet = factory(Snippet::class)->create();

        $action = (new SnippetDeletionAction)->execute([
            'snippet' => $snippet,
        ]);

        $this->assertTrue($action->completed());
        $this->assertDatabaseMissing('snippets', [
            'reference_id' => $snippet->reference_id,
        ]);
    }

    /** @test */
    public function it_requires_a_snippet()
    {
        $action = (new SnippetDeletionAction)->execute();

        $this->assertFalse($action->completed());
    }
}
