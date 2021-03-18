<?php

namespace App\Http\Livewire\Backstage;

use App\Actions\Posts\PostDeletingAction;
use App\Actions\Series\AddPostToSeriesAction;
use App\Actions\Series\RemovePostFromSeriesAction;
use App\Http\Livewire\DisplaysAlerts;
use App\Post;
use App\Series;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class PostShow extends Component
{
    use AuthorizesRequests, DisplaysAlerts;

    /**
     * The post under inspection.
     *
     * @var Post
     */
    public $post;

    /**
     * The ID of the series we will add the post to.
     *
     * @var string
     */
    public $seriesIdToAdd;

    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount($ref)
    {
        $this->post = Post::findByReferenceId($ref);
        $this->post->load('series');

        if (! $this->post) {
            $this->flash('You are attempting to view an invalid post.', 'error');

            return redirect()->back();
        }

        $this->authorize('view', $this->post);
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        $availableSeries = Series::orderBy('name')
            ->whereNotIn('id', $this->post->series->pluck('id'))
            ->pluck('name', 'id');

        return view('livewire.backstage.post-show')
            ->with('availableSeries', $availableSeries);
    }

    /**
     * Remove this post from the database.
     *
     * @return void
     */
    public function delete()
    {
        $action = PostDeletingAction::execute([
            'post' => $this->post,
        ]);

        if ($action->failed()) {
            $this->alert($action->getMessage(), 'error');

            return;
        }

        $this->flash($action->getMessage(), 'success');

        return redirect()->route('backstage.posts.index');
    }

    /**
     * Add this post to a series.
     *
     * @param string $series
     * @return void
     */
    public function addSeries()
    {
        if (! $series = Series::find($this->seriesIdToAdd)) {
            $this->alert('Invalid series selected.', 'error');

            return;
        }

        $action = AddPostToSeriesAction::execute([
            'post' => $this->post,
            'series' => $series,
        ]);

        if ($action->failed()) {
            $this->alert($action->getMessage(), 'error');

            return;
        }

        $this->post->load('series');
        $this->alert($action->getMessage(), 'success');
    }

    /**
     * Remove this post from a series.
     *
     * @param string $series
     * @return void
     */
    public function removeSeries($series)
    {
        if (! $series = Series::find($series)) {
            return;
        }

        $action = RemovePostFromSeriesAction::execute([
            'post' => $this->post,
            'series' => $series,
        ]);

        if ($action->failed()) {
            $this->alert($action->getMessage(), 'error');

            return;
        }

        $this->post->load('series');
        $this->alert($action->getMessage(), 'success');
    }
}
