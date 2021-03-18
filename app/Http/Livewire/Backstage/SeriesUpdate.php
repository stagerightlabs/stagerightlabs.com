<?php

namespace App\Http\Livewire\Backstage;

use App\Actions\Series\SeriesUpdatingAction;
use App\Http\Livewire\DisplaysAlerts;
use App\Series;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class SeriesUpdate extends Component
{
    use AuthorizesRequests, DisplaysAlerts;

    /**
     * The series that is being updated.
     *
     * @var Series
     */
    public $series;

    /**
     * Validation rules.
     *
     * @var array
     */
    protected $rules = [
        'series.description' => 'nullable',
        'series.name' => 'required',
        'series.slug' => 'required',
    ];

    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount($ref)
    {
        $this->series = Series::findByReferenceId($ref);

        if (! $this->series) {
            $this->flash('You are trying to edit an invalid series.', 'error');

            return redirect()->back();
        }

        $this->authorize('update', $this->series);
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.backstage.series-update');
    }

    /**
     * Update the series.
     *
     * @return void
     */
    public function update()
    {
        $this->validate();

        $action = SeriesUpdatingAction::execute([
            'description' => $this->series->description,
            'name' => $this->series->name,
            'series' => $this->series,
        ]);

        if ($action->failed()) {
            $this->alert($action->getMessage(), 'error');

            return;
        }

        $this->flash($action->getMessage(), 'success');

        return redirect()->route('backstage.series.show', $this->series->reference_id);
    }
}
