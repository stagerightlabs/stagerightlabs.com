<?php

namespace App\Http\Livewire\Backstage;

use App\Http\Livewire\DisplaysAlerts;
use App\Series;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class SeriesIndex extends Component
{
    use AuthorizesRequests, DisplaysAlerts;

    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount()
    {
        $this->authorize('viewAny', Series::class);
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.backstage.series-index', [
            'series' => Series::orderByDesc('created_at')->paginate(),
        ]);
    }
}
