<?php

namespace App\Http\Livewire\Backstage;

use App\Actions\Series\SeriesCreatingAction;
use App\Http\Livewire\DisplaysAlerts;
use App\Series;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class SeriesCreate extends Component
{
    use AuthorizesRequests, DisplaysAlerts;

    /**
     * The name for the new series.
     *
     * @var string
     */
    public $name;

    /**
     * The description for the new series.
     *
     * @var string
     */
    public $description;

    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount()
    {
        $this->authorize('create', Series::class);
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.backstage.series-create');
    }

    /**
     * Store a new series in the database.
     *
     * @return void
     */
    public function store()
    {
        $this->validate([
            'name' => 'required',
        ]);

        $action = SeriesCreatingAction::execute([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        if ($action->failed()) {
            $this->alert($action->getMessage(), 'error');

            return;
        }

        $this->flash($action->getMessage(), 'success');

        return redirect()->route('backstage.series.show', $action->series->reference_id);
    }
}
