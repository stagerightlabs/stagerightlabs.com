<?php

namespace App\View\Components;

use Illuminate\View\Component;
use League\CommonMark\CommonMarkConverter;

/**
 * Inspired by the Blade UI Kit
 * https://blade-ui-kit.com/docs/0.x/markdown.
 */
class Markdown extends Component
{
    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|string
     */
    public function render()
    {
        return view('components.markdown');
    }

    /**
     * Convert markdown content to HTML.
     *
     * @param string $markdown
     * @return string
     */
    public function toHtml(string $markdown)
    {
        return (new CommonMarkConverter())->convertToHtml($markdown);
    }
}
