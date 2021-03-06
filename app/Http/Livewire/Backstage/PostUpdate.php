<?php

namespace App\Http\Livewire\Backstage;

use App\Actions\Posts\PostUpdatingAction;
use App\Http\Livewire\DisplaysAlerts;
use App\Post;
use App\Tag;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class PostUpdate extends Component
{
    use AuthorizesRequests, DisplaysAlerts;

    /**
     * The tags available for selection.
     *
     * @var array
     */
    public $availableTags = [];

    /**
     * The content of the post to be updated.
     *
     * @var string
     */
    public $content;

    /**
     * The description of the post to be updated.
     *
     * @var string
     */
    public $description;

    /**
     * The post under review.
     *
     * @var Post
     */
    public $post;

    /**
     * The date the post has been marked as published.
     *
     * @var string
     */
    public $publishedAt;

    /**
     * A description of the tools used in this post.
     *
     * @var string
     */
    public $stackOutline;

    /**
     * The tags selected for the post to be updated.
     *
     * @var array
     */
    public $tags = [];

    /**
     * The title of the post to be updated.
     *
     * @var string
     */
    public $title;

    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount($ref)
    {
        $this->post = Post::findByReferenceId($ref);

        if (! $this->post) {
            $this->flash('You are trying to edit an invalid post.', 'error');

            return redirect()->back();
        }

        $this->authorize('update', $this->post);

        $this->availableTags = Tag::orderBy('name')
            ->pluck('name', 'slug')
            ->toArray();
        $this->content = $this->post->content;
        $this->description = $this->post->description;
        $this->publishedAt = $this->post->published_at
            ? $this->post->published_at->format('Y-m-d')
            : '';
        $this->stackOutline = $this->post->stack_outline;
        $this->tags = $this->post->tags->pluck('slug')->toArray();
        $this->title = $this->post->title;
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.backstage.post-update');
    }

    /**
     * Save the updates to the database.
     *
     * @return void
     */
    public function update()
    {
        $this->validate([
            'content' => 'required',
            'title' => 'required',
            'publishedAt' => 'nullable|date_format:Y-m-d',
        ], [
            'publishedAt.date_format' => 'Please use the Y-m-d format.',
        ]);

        $action = PostUpdatingAction::execute([
            'content' => $this->content,
            'description' => $this->description,
            'post' => $this->post,
            'published_at' => $this->publishedAt,
            'stack_outline' => $this->stackOutline,
            'tags' => $this->tags,
            'title' => $this->title,
        ]);

        if ($action->failed()) {
            $this->alert($action->getMessage(), 'error');

            return;
        }

        $this->flash($action->getMessage(), 'success');

        return redirect()->route('backstage.posts.show', $this->post->reference_id);
    }
}
