<?php

namespace App\Http\Livewire\Backstage;

use App\Actions\Snippets\SnippetDeletingAction;
use App\Http\Livewire\DisplaysAlerts;
use App\Snippet;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class SnippetShow extends Component
{
    use AuthorizesRequests, DisplaysAlerts;

    /**
     * The snippet under inspection.
     *
     * @var Snippet
     */
    public $snippet;

    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount($ref)
    {
        $this->snippet = Snippet::findByReferenceId($ref);

        if (! $this->snippet) {
            $this->flash('You are trying to view an invalid snippet.', 'error');
        }

        $this->authorize('view', $this->snippet);
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.backstage.snippet-show', [
            'snippet' => $this->snippet,
        ]);
    }

    /**
     * Remove this snippet from the database.
     *
     * @return void
     */
    public function remove()
    {
        $this->authorize('delete', $this->snippet);

        $action = (new SnippetDeletingAction)->execute([
            'snippet' => $this->snippet,
        ]);

        if ($action->failed()) {
            $this->alert($action->getMessage(), 'error');

            return;
        }

        $this->flash($action->getMessage(), 'success');

        return redirect()->route('backstage.snippets.index');
    }
}
