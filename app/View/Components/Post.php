<?php

namespace App\View\Components;

use App\Post as EloquentPost;
use Illuminate\View\Component;

class Post extends Component
{
    /**
     * The post to display.
     *
     * @var EloquentPost
     */
    public $post;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($post)
    {
        $this->post = $post;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\View\View|string
     */
    public function render()
    {
        return view('components.post');
    }
}
