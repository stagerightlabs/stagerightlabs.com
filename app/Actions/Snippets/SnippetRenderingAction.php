<?php

namespace App\Actions\Snippets;

use App\Jobs\PostRenderingJob;
use App\Utilities\Arr;
use StageRightLabs\Actions\Action;

class SnippetRenderingAction extends Action
{
    const HTML_START = "<div class=\"snippet border border-cool-gray-400 bg-cool-gray-600 rounded w-full mb-6 font-mono relative h-auto\"><div class=\"relative overflow-x-auto p-1\">\n";
    const HTML_END = "</div>\n";
    const TABLE_START = '<table><tbody>';
    const TABLE_END = "</tbody></table></div>\n";
    const ROW_START = '<tr><td class="text-cool-gray-500 text-right select-none">';
    const ROW_MIDDLE = '</td><td class="text-cool-gray-300 whitespace-pre px-2 text-sm">';
    const ROW_END = "</td></tr>\n";
    const FOOTER_START = '<div class="p-1 text-right text-cool-gray-300 bg-cool-gray-500">';
    const FOOTER_END = "</div>\n";
    const FALLBACK_FILENAME = 'View File';

    /**
     * @var Snippet
     */
    public $snippet;

    /**
     * @var string
     */
    public $rendered;

    /**
     * @var string
     */
    public $markdown;

    /**
     * Render the contents of a snippet into HTML.
     *
     * @param Action|array $input
     * @return self
     */
    public function handle($input = [])
    {
        $snippet = $input['snippet'];
        $cascade = Arr::get($input, 'cascade', true);

        // Ensure there is content to be rendered.
        if (empty($snippet->content)) {
            return $this->fail('Snippet has no content to render.');
        }

        $this->rendered = $this->renderHtml($snippet);
        $this->markdown = $this->renderMarkdown($snippet);

        // Should we also render the posts that use this snippet?
        if ($cascade) {
            $this->renderRelatedPosts($snippet);
        }

        return $this->complete('Snippet has been rendered');
    }

    /**
     * Render the content of the snippet as a chunk of HTML.
     *
     * @param string $content
     * @param Snippet $snippet
     * @return string
     */
    protected function renderHtml($snippet)
    {
        $number = $snippet->starting_line;
        $opening = "<!-- Snippet {$snippet->reference_id} -->\n"
            . self::HTML_START
            . self::TABLE_START;

        // Content
        $html = collect(explode("\n", $snippet->content))
            ->reduce(function ($carry, $row) use (&$number) {
                $carry = $carry .= self::ROW_START
                    . $number
                    . self::ROW_MIDDLE
                    . $this->encode($row)
                    . self::ROW_END;

                $number++;

                return $carry;
            }, $opening) . self::TABLE_END;

        // Optional Footer
        $html .= $this->footer($snippet->filename, $snippet->url);

        // Closing
        $html .= self::HTML_END;

        return $html;
    }

    /**
     * Render the snippet footer, if needed.
     *
     * @return string
     */
    protected function footer($filename = null, $url = null)
    {
        if (!$filename && !$url) {
            return '';
        }

        $footer = self::FOOTER_START;

        if ($url) {
            $footer .= "<a href=\"{$url}\" target=\"_blank\">";
        }

        $footer .= empty($filename)
            ? self::FALLBACK_FILENAME
            : $filename;

        if ($url) {
            $footer .= '</a>';
        }

        return $footer .= self::FOOTER_END;
    }

    /**
     * Convert special characters to their HTML safe equivalents.
     *
     * @param string $text
     * @return string
     */
    protected function encode($text)
    {
        return htmlspecialchars($text, ENT_QUOTES);
    }

    /**
     * Queue rendering jobs for the posts that use this snippet.
     *
     * @param Snippet $snippet
     * @return void
     */
    protected function renderRelatedPosts($snippet)
    {
        $snippet->getPostsThatUseThisSnippet()
            ->each(function ($post) {
                PostRenderingJob::dispatch($post);
            });
    }

    /**
     * Render the snippet as a markdown string.
     *
     * @param Snippet $snippet
     * @return string
     */
    protected function renderMarkdown($snippet): string
    {
        return "```{$snippet->language}\n"
            . $this->encode($snippet->content)
            . "\n```";
    }

    /**
     * The input keys used in this action that are not required.
     *
     * @return array
     */
    public function optional()
    {
        return [
            'cascade', // bool: Should we also render related posts?
        ];
    }

    /**
     * The input keys required by this action.
     *
     * @return array
     */
    public function required()
    {
        return [
            'snippet', // Snippet
        ];
    }
}
