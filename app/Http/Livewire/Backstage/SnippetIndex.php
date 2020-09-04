<?php

namespace App\Http\Livewire\Backstage;

use App\Http\Livewire\DisplaysAlerts;
use App\Snippet;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class SnippetIndex extends Component
{
    use AuthorizesRequests, DisplaysAlerts;

    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount()
    {
        $this->authorize('viewAny', Snippet::class);
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.backstage.snippet-index', [
            'snippets' => Snippet::orderBy('name')->paginate()
        ]);
    }
}
