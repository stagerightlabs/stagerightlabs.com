<?php

namespace App\Http\Livewire;

use App\Series;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class PublicSeriesShow extends Component
{
    use AuthorizesRequests, DisplaysAlerts;

    /**
     * The series being viewed.
     *
     * @var Series
     */
    public $series;

    /**
     * Mount the component.
     *
     * @param string $slug
     * @return void
     */
    public function mount($slug)
    {
        $this->series = Series::containingPublishedPosts()
            ->with('publishedPosts')
            ->where('series.slug', $slug)
            ->first();

        if (! $this->series) {
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
        return view('livewire.public-series-show');
    }
}
