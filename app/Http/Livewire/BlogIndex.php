<?php

namespace App\Http\Livewire;

use App\Post;
use App\Tag;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;
use Livewire\WithPagination;

class BlogIndex extends Component
{
    use AuthorizesRequests, DisplaysAlerts, WithPagination;

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.blog-index', [
            'posts' => Post::published()->orderBy('published_at')->paginate(),
            'tags' => Tag::orderBy('name')->get(),
        ]);
    }
}
