<?php

namespace Tests\Feature\Backstage;

use App\Tag;
use App\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Livewire\Livewire;
use Tests\TestCase;

class TagDeletionTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function users_can_remove_unassigned_tags()
    {
        $this->actingAs(factory(User::class)->create());

        $tag = factory(Tag::class)->create();

        Livewire::test('backstage.tag-index')
            ->call('remove', $tag->reference_id);

        $this->assertDatabaseMissing('tags', [
            'reference_id' => $tag->reference_id,
        ]);
    }

    /** @test */
    public function users_cannot_delete_tags_assigned_to_posts()
    {
        $this->markTestSkipped();
    }
}
