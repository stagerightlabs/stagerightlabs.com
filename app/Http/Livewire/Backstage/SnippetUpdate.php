<?php

namespace App\Http\Livewire\Backstage;

use App\Actions\Snippets\SnippetUpdatingAction;
use App\Http\Livewire\DisplaysAlerts;
use App\Snippet;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class SnippetUpdate extends Component
{
    use AuthorizesRequests, DisplaysAlerts;

    /**
     * The content of the snippet.
     *
     * @var string
     */
    public $content;

    /**
     * The name of the file that contains the snippet.
     *
     * @var string
     */
    public $filename;

    /**
     * The language that should be used for syntax highlighting.
     *
     * @var string
     */
    public $language;

    /**
     * The name of the new snippet.
     *
     * @var string
     */
    public $name;

    /**
     * The snippet under review.
     *
     * @var Snippet
     */
    public $snippet;

    /**
     * The starting point for line numbers.
     *
     * @var int
     */
    public $startingLineNumber = 1;

    /**
     * The url associated with the snippet.
     *
     * @var string
     */
    public $url;

    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount($ref)
    {
        $this->snippet = Snippet::findByReferenceId($ref);

        if (! $this->snippet) {
            $this->flash('You are trying to view an invalid snippet.', 'error');
        }

        $this->authorize('update', $this->snippet);

        $this->content = $this->snippet->content;
        $this->filename = $this->snippet->filename;
        $this->language = $this->snippet->language;
        $this->name = $this->snippet->name;
        $this->startingLineNumber = $this->snippet->starting_line;
        $this->url = $this->snippet->url;
    }

    /**
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.backstage.snippet-update', [
            'snippet' => $this->snippet,
        ]);
    }

    /**
     * Update the snippet.
     *
     * @return void
     */
    public function update()
    {
        $this->authorize('update', $this->snippet);

        $this->validate([
            'content' => 'required',
            'name' => 'required',
        ]);

        $action = SnippetUpdatingAction::execute([
            'content' => $this->content,
            'filename' => $this->filename,
            'language' => $this->language,
            'name' => $this->name,
            'snippet' => $this->snippet,
            'starting_line' => $this->startingLineNumber,
            'url' => $this->url,
        ]);

        if ($action->failed()) {
            $this->alert($action->getMessage(), 'error');

            return;
        }

        $this->flash($action->getMessage(), 'success');

        return redirect()->route(
            'backstage.snippets.show',
            $action->snippet->reference_id
        );
    }
}
