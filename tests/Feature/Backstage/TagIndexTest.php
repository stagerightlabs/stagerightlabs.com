<?php

namespace Tests\Feature\Backstage;

use App\Http\Livewire\Backstage\TagIndex;
use App\Tag;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class TagIndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_view_the_tag_index()
    {
        Livewire::test(TagIndex::class)
            ->assertForbidden();
    }

    /** @test */
    public function users_can_view_the_tag_index()
    {
        $this->actingAs(User::factory()->create());
        $tag = Tag::factory()->create();

        Livewire::test(TagIndex::class)
            ->assertSee($tag->name);
    }
}
