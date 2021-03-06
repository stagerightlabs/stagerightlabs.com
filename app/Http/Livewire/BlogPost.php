<?php

namespace App\Http\Livewire;

use App\Post;
use Livewire\Component;

class BlogPost extends Component
{
    /**
     * The post being read.
     *
     * @var Post
     */
    public $post;

    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount($slug)
    {
        $this->post = Post::with(['tags', 'series', 'series.publishedPosts'])
            ->published()
            ->where('slug', $slug)
            ->first();

        if (! $this->post) {
            abort(404);
        }
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.blog-post');
    }
}
