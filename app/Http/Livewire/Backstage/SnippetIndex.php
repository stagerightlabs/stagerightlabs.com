<?php

namespace App\Http\Livewire\Backstage;

use App\Http\Livewire\DisplaysAlerts;
use App\Jobs\SnippetRenderingJob;
use App\Snippet;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class SnippetIndex extends Component
{
    use AuthorizesRequests, DisplaysAlerts, WithPagination;

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
            'snippets' => Snippet::orderBy('name')->paginate(),
        ]);
    }

    /**
     * Trigger batch rendering for all snippets.
     *
     * @return void
     */
    public function dispatchBatchRenderingJobs()
    {
        Snippet::get()
            ->each(function ($snippet) {
                dispatch(new SnippetRenderingJob($snippet, $cascade = false));
            });

        $this->alert('Rendering jobs have been queued.', 'success');
    }
}
