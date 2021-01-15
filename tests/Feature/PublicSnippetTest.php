<?php

namespace Tests\Feature;

use App\Snippet;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class PublicSnippetTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function public_snippets_are_reachable()
    {
        $snippet = Snippet::factory()->public()->create();

        $response = $this->get(route('public.snippet', $snippet->reference_id));

        $response->assertSee($snippet->name);
    }

    /** @test */
    public function private_snippets_are_not_reachable()
    {
        $snippet = Snippet::factory()->create();

        $response = $this->get(route('public.snippet', $snippet->reference_id));

        $response->assertStatus(404);
        $response->assertDontSee($snippet->name);
    }
}
