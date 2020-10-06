<?php

namespace Tests\Unit\Actions\Snippets;

use App\Actions\Snippets\SnippetDeletingAction;
use App\Snippet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class SnippetDeletingActionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function it_removes_snippets_from_the_database()
    {
        $snippet = Snippet::factory()->create();

        $action = (new SnippetDeletingAction)->execute([
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
        $action = (new SnippetDeletingAction)->execute();

        $this->assertFalse($action->completed());
    }
}
