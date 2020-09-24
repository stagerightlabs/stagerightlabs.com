<?php

namespace App\Http\Livewire\Backstage;

use App\Http\Livewire\DisplaysAlerts;
use App\Post;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Livewire\Component;

class PostPreview extends Component
{
    use AuthorizesRequests, DisplaysAlerts;

    /**
     * The post under inspection.
     *
     * @var Post
     */
    public $post;

    /**
     * Mount the component.
     *
     * @return void
     */
    public function mount($ref)
    {
        $this->post = Post::findByReferenceId($ref);

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
        return view('livewire.backstage.post-preview');
    }
}
