<?php

namespace App\Http\Livewire;

use App\Tag;
use Livewire\Component;
use Livewire\WithPagination;

class BlogTopic extends Component
{
    use WithPagination;

    /**
     * The tag that will serve as our content filter.
     *
     * @var Tag
     */
    public $topic;

    /**
     * The available topics to choose from.
     *
     * @var Collection
     */
    public $tags;

    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount($topic)
    {
        $this->topic = Tag::findBySlug($topic);

        if (! $this->topic) {
            return redirect()->route('home');
        }

        $this->tags = Tag::orderBy('name')->get();
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.blog-index', [
            'posts' => $this->topic->posts()
                ->published()
                ->orderBy('published_at')
                ->paginate(10),
            'topic' => $this->topic,
        ]);
    }
}
