<?php

namespace App\Http\Livewire;

use App\Snippet;
use Livewire\Component;

class PublicSnippet extends Component
{
    /**
     * The snippet under inspection.
     *
     * @var Snippet
     */
    public $snippet;

    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount($ref)
    {
        $this->snippet = Snippet::public()->where('reference_id', $ref)->first();

        if (! $this->snippet) {
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
        return view('livewire.public-snippet');
    }
}
