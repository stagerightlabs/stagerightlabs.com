<?php

namespace App\Http\Livewire\Backstage;

use App\Http\Livewire\DisplaysAlerts;
use App\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class PostIndex extends Component
{
    use AuthorizesRequests, DisplaysAlerts, WithPagination;

    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount()
    {
        $this->authorize('viewAny', Post::class);
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.backstage.post-index', [
            'posts' => Post::orderBy('created_at')->paginate(),
        ]);
    }
}
