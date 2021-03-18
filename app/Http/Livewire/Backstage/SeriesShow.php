<?php

namespace App\Http\Livewire\Backstage;

use App\Actions\Series\ChangeSortOrderAction;
use App\Actions\Series\SeriesDeletingAction;
use App\Http\Livewire\DisplaysAlerts;
use App\Series;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class SeriesShow extends Component
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
     * @return void
     */
    public function mount($ref)
    {
        $this->series = Series::findByReferenceId($ref)->load('posts');

        if (! $this->series) {
            $this->flash('You are attempting to view an invalid series.', 'error');

            return redirect()->back();
        }

        $this->authorize('view', $this->series);
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.backstage.series-show');
    }

    /**
     * Remove this series from the database.
     *
     * @return void
     */
    public function remove()
    {
        $this->authorize('delete', $this->series);

        $action = SeriesDeletingAction::execute([
            'series' => $this->series,
        ]);

        if ($action->failed()) {
            $this->alert($action->getMessage(), 'error');

            return;
        }

        $this->flash($action->getMessage(), 'success');

        return redirect()->route('backstage.series.index');
    }

    /**
     * Update the sort order for the posts in this series.
     *
     * @param array $payload
     * @return void
     */
    public function updatePostOrder($payload)
    {
        $order = collect($payload)->map(function ($sorted) {
            return $sorted['value'];
        });

        $action = ChangeSortOrderAction::execute([
            'order' => $order->toArray(),
            'series' => $this->series,
        ]);

        if ($action->failed()) {
            $this->alert($action->getMessage(), 'error');

            return;
        }

        $this->series->load('posts');
    }
}
