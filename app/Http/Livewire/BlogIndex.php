<?php

namespace App\Http\Livewire;

use App\Post;
use App\Tag;
use Illuminate\Pagination\Paginator;
use Livewire\Component;
use Livewire\WithPagination;

class BlogIndex extends Component
{
    use WithPagination;

    /**
     * We are overwriting this method from the WithPagination Trait to allow
     * us to intercept the resolution of the current page number from the
     * query string values.  Currently there is no validation happening
     * and an invalid page number will throw an error. By customizing
     * this handler we can ensure that there is a graceful fallback.
     *
     * @return void
     */
    public function initializeWithPagination()
    {
        $this->page = $this->resolvePage();

        Paginator::currentPageResolver(function () {
            return $this->resolvePage();
        });

        Paginator::defaultView($this->paginationView());
        Paginator::defaultSimpleView($this->paginationSimpleView());
    }

    /**
     * Resolve the current page from the query string in the request,
     * discarding invalid values.
     */
    public function resolvePage()
    {
        // The "page" query string item should only be available
        // from within the original component mount run.
        return intval(request()->query('page', $this->page));
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.blog-index', [
            'posts' => Post::published()
                ->orderByDesc('published_at')
                ->paginate(10),
            'tags' => Tag::orderBy('name')->get(),
        ]);
    }
}
