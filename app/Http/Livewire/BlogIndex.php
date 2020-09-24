<?php

namespace App\Http\Livewire;

use App\Post;
use App\Tag;
use Livewire\Component;
use Livewire\WithPagination;

class BlogIndex extends Component
{
    use WithPagination;

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.blog-index', [
            'posts' => Post::published()->orderBy('published_at')->paginate(10),
            'tags' => Tag::orderBy('name')->get(),
        ]);
    }

    /**
     * Set the template to use for pagination links.
     *
     * @return string
     */
    public function paginationView()
    {
        return 'vendor.livewire.pagination-links-compact';
    }
}
