<?php

namespace App\View\Components;

use App\Post as EloquentPost;
use App\Utilities\Arr;
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
        if (! $this->post->published_at) {
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
        $yearsOld = $this->post->published_at->diffInYears(now());

        if ($yearsOld < 1) {
            return '';
        }

        if ($yearsOld == 1) {
            return 'a year old;';
        }

        $numbers = [
            2 => 'two',
            3 => 'three',
            4 => 'four',
            5 => 'five',
            6 => 'six',
            7 => 'seven',
            8 => 'eight',
            9 => 'nine',
            10 => 'ten',
            11 => 'eleven',
            12 => 'twelve',
            13 => 'thirteen',
            14 => 'fourteen',
        ];

        return  Arr::get($numbers, $yearsOld, $yearsOld).' years old;';
    }
}
