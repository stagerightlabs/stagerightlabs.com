<?php

namespace App\Http\Livewire\Backstage;

use App\Actions\Tags\TagDeletingAction;
use App\Http\Livewire\DisplaysAlerts;
use App\Tag;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class TagIndex extends Component
{
    use AuthorizesRequests, DisplaysAlerts;

    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount()
    {
        $this->authorize('viewAny', Tag::class);
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.backstage.tag-index', [
            'tags' => Tag::orderBy('name')->paginate(25),
        ]);
    }

    /**
     * Attempt to remove a tag from the database.
     *
     * @param string $ref
     * @return void
     */
    public function remove($ref)
    {
        $tag = Tag::findByReferenceId($ref);

        if (! $tag) {
            $this->alert('You are attempting to remove an invalid tag.'.'error');

            return;
        }

        $this->authorize('delete', $tag);

        $action = (new TagDeletingAction)->execute([
            'tag' => $tag,
        ]);

        if ($action->failed()) {
            $this->alert($action->getMessage(), 'error');

            return;
        }

        $this->alert($action->getMessage(), 'success');
    }
}
