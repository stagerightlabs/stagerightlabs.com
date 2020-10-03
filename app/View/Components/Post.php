<?php

namespace App\View\Components;

use App\Post as EloquentPost;
use Carbon\CarbonInterface;
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

    /**
     * Was this post published more than a year ago?
     *
     * @return bool
     */
    public function wasPublishedMoreThanAYearAgo()
    {
        if (!$this->post->published_at) {
            return false;
        }

        return $this->post->published_at->lt(now()->subYear(1));
    }

    /**
     * Generate a string that presents the age of the post as a text sentence.
     *
     * @return string
     */
    public function publicationAgeForHumans()
    {
        if ($this->post->published_at->lt(now()->subYear(2))) {
            return  $this->post->published_at->longAbsoluteDiffForHumans()
            . ' old;';
        }

        return 'a year old;';
    }
}
