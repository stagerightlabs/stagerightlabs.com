<?php

namespace App\Http\Livewire\Backstage;

use App\Actions\Tags\TagUpdatingAction;
use App\Http\Livewire\DisplaysAlerts;
use App\Tag;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class TagUpdate extends Component
{
    use AuthorizesRequests, DisplaysAlerts;

    /**
     * The new name for the tag.
     *
     * @var string
     */
    public $name;

    /**
     * The new slug for the tag;.
     *
     * @var string
     */
    public $slug;

    /**
     * The tag under review.
     *
     * @var Tag
     */
    public $tag;

    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount($ref)
    {
        $tag = Tag::findByReferenceId($ref);

        if (! $tag) {
            $this->flash('You are trying to edit an invalid tag', 'error');

            return redirect()->route('backstage.tags.index');
        }

        $this->authorize('update', $tag);

        $this->name = $tag->name;
        $this->slug = $tag->slug;
        $this->tag = $tag;
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.backstage.tag-update');
    }

    /**
     * Update the tag.
     *
     * @return void
     */
    public function update()
    {
        $this->authorize('update', $this->tag);

        $this->validate([
            'name' => 'required',
        ]);

        $action = TagUpdatingAction::execute([
            'name' => $this->name,
            'slug' => $this->slug,
            'tag' => $this->tag,
        ]);

        if ($action->failed()) {
            $this->alert($action->getMessage(), 'error');

            return;
        }

        $this->flash($action->getMessage(), 'success');

        return redirect()->route('backstage.tags.index');
    }
}
