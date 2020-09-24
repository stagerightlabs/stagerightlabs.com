<?php

namespace Tests\Feature\Backstage;

use App\Http\Livewire\Backstage\TagCreate;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class TagCreationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function guests_cannot_create_tags()
    {
        Livewire::test(TagCreate::class)
            ->assertForbidden();
    }

    /** @test */
    public function users_can_create_tags()
    {
        $this->actingAs(factory(User::class)->create());

        Livewire::test(TagCreate::class)
            ->set('name', 'New Tag Name')
            ->call('store');

        $this->assertDatabaseHas('tags', [
            'name' => 'New Tag Name',
            'slug' => 'new-tag-name',
        ]);
    }

    /** @test */
    public function it_requires_a_tag_name()
    {
        $this->actingAs(factory(User::class)->create());

        Livewire::test(TagCreate::class)
            ->call('store')
            ->assertHasErrors('name');
    }
}
