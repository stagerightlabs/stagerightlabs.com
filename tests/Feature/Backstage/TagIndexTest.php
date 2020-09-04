<?php

namespace Tests\Feature\Backstage;

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
        Livewire::test('backstage.tag-index')
            ->assertForbidden();
    }

    /** @test */
    public function users_can_view_the_tag_index()
    {
        $this->actingAs(factory(User::class)->create());
        $tag = factory(Tag::class)->create();

        Livewire::test('backstage.tag-index')
            ->assertSee($tag->name);
    }
}
