<?php

namespace App\Http\Livewire\Backstage;

use App\Actions\PostCreatingAction;
use App\Http\Livewire\DisplaysAlerts;
use App\Post;
use App\Tag;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class PostCreate extends Component
{
    use AuthorizesRequests, DisplaysAlerts;

    /**
     * The tags available for selection.
     *
     * @var array
     */
    public $availableTags = [];

    /**
     * The content of the post to be created.
     *
     * @var string
     */
    public $content;

    /**
     * The tags selected for the post to be created.
     *
     * @var array
     */
    public $tags = [];

    /**
     * The title of the post to be created.
     *
     * @var string
     */
    public $title;

    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount()
    {
        $this->authorize('create', Post::class);

        $this->availableTags = Tag::pluck('name', 'slug')->toArray();
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.backstage.post-create');
    }

    /**
     * Store a new blog post in the database.
     *
     * @return void
     */
    public function store()
    {
        $this->validate([
            'content' => 'required',
            'title' => 'required',
        ]);

        $action = (new PostCreatingAction)->execute([
            'author' => auth()->user(),
            'content' => $this->content,
            'tags' => $this->tags,
            'title' => $this->title,
        ]);

        if ($action->failed()) {
            $this->alert($action->getMessage(), 'error');
            return;
        }

        $this->flash($action->getMessage(), 'success');
        return redirect()->route('backstage.posts.index');
    }
}
