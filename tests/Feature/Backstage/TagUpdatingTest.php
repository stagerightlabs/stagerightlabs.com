<?php

namespace Tests\Feature\Backstage;

use App\Http\Livewire\Backstage\TagUpdate;
use App\Tag;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class TagUpdatingTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_guest_cannot_update_a_tag()
    {
        $tag = Tag::factory()->create();

        Livewire::test(TagUpdate::class, ['ref' => $tag->reference_id])
            ->assertForbidden();
    }

    /** @test */
    public function a_user_can_update_a_tag()
    {
        $this->actingAs(User::factory()->create());
        $tag = Tag::factory()->create([
            'name' => 'Old Name',
        ]);

        Livewire::test(TagUpdate::class, ['ref' => $tag->reference_id])
            ->set('name', 'Some New Name')
            ->set('slug', 'some-new-slug')
            ->call('update');

        $this->assertDatabaseHas('tags', [
            'reference_id' => $tag->reference_id,
            'name' => 'Some New Name',
            'slug' => 'some-new-slug',
        ]);
    }

    /** @test */
    public function it_requires_a_tag_name()
    {
        $this->actingAs(User::factory()->create());
        $tag = Tag::factory()->create([
            'name' => 'Old Name',
        ]);

        Livewire::test(TagUpdate::class, ['ref' => $tag->reference_id])
            ->set('name', '')
            ->call('update')
            ->assertHasErrors('name');
    }
}
