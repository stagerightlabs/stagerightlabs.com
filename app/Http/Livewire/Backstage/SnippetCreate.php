<?php

namespace App\Http\Livewire\Backstage;

use App\Actions\Snippets\SnippetCreatingAction;
use App\Http\Livewire\DisplaysAlerts;
use App\Snippet;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class SnippetCreate extends Component
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
     * Should this snippet be flagged for public access?
     *
     * @var bool
     */
    public $isPublic = false;

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
     * Render the component.
     *
     * @return \Illuminate\View\View
     */
    public function render()
    {
        return view('livewire.backstage.snippet-create');
    }

    /**
     * Store a new snippet in the database.
     *
     * @return void
     */
    public function store()
    {
        $this->validate([
            'content' => 'required',
            'name' => 'required',
        ]);

        $this->authorize('create', Snippet::class);

        $action = SnippetCreatingAction::execute([
            'content' => $this->content,
            'filename' => $this->filename,
            'is_public' => $this->isPublic,
            'language' => $this->language,
            'name' => $this->name,
            'starting_line' => $this->startingLineNumber,
            'url' => $this->url,
        ]);

        if ($action->failed()) {
            $this->alert($action->getMessage(), 'error');

            return;
        }

        $this->flash($action->getMessage(), 'success');

        return redirect()->route('backstage.snippets.show', $action->snippet->reference_id);
    }
}
