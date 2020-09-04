<?php

namespace App\Http\Livewire\Backstage;

use App\Actions\Tags\TagCreationAction;
use App\Http\Livewire\DisplaysAlerts;
use App\Tag;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class TagCreate extends Component
{
    use AuthorizesRequests, DisplaysAlerts;

    /**
     * The name of the new tag that will be created.
     *
     * @var string
     */
    public $name;

    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount()
    {
        $this->authorize('create', Tag::class);
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.backstage.tag-create');
    }

    /**
     * Store the new tag in the database.
     *
     * @return void
     */
    public function store()
    {
        $this->authorize('create', Tag::class);

        $this->validate([
            'name' => 'required',
        ]);

        $action = (new TagCreationAction)->execute([
            'name' => $this->name,
        ]);

        if ($action->failed()) {
            $this->alert($action->getMessage(), 'error');

            return;
        }

        $this->flash($action->getMessage(), 'success');

        return redirect()->route('backstage.tags.index');
    }
}
