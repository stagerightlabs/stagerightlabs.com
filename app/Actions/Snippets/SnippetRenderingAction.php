<?php

namespace App\Actions\Snippets;

use App\Actions\Complete;
use App\Actions\Failure;
use App\Actions\Reaction;
use App\Utilities\Arr;
use App\Utilities\Str;

/**
 * Render the content of a snippet as HTML.
 *
 * Expected Input:
 *  - 'snippet' (Snippet)
 */
class SnippetRenderingAction
{
    const HTML_START = "<div class=\"border border-cool-gray-400 bg-cool-gray-600 rounded w-full mb-4 p-2 font-mono overflow-x-auto relative\"><table><tbody>\n";
    const HTML_END = "</div>\n";
    const TABLE_END = "</tbody></table>\n";
    const ROW_START = "<tr><td class=\"text-cool-gray-500 text-right select-none\">";
    const ROW_MIDDLE = "</td><td class=\"text-cool-gray-300 whitespace-pre px-2 text-sm\">";
    const ROW_END = "</td></tr>\n";
    const FOOTER_START = "<div class=\"absolute right-2 bottom-1 text-cool-gray-400\">";
    const FOOTER_END = "</div>\n";
    const FALLBACK_FILENAME = "View File";


    /**
     * Execute the action.
     *
     * @param array $data
     * @return Reaction
     */
    public function execute($data = [])
    {
        if ($missing = Arr::disclose($data, ['snippet'])) {
            return new Failure("Missing expected '{$missing[0]}' value.");
        }

        $snippet = $data['snippet'];

        // Is there content to be rendered?
        if (empty($snippet->content)) {
            return new Failure("Snippet has no content to render.");
        }

        // generate the rendered html
        $html = $this->render($snippet);

        // Cache handling would occur here...

        // All set
        return new Complete("Snippet has been rendered", [
            'rendered' => $html,
            'snippet' => $snippet,
        ]);
    }

    /**
     * Render the content of the snippet as a chunk of HTML.
     *
     * @param string $content
     * @param Snippet $snippet
     * @return string
     */
    protected function render($snippet)
    {
        $number = $snippet->starting_line;

        // Content
        $html = collect(explode("\n", $snippet->content))
            ->reduce(function($carry, $row) use (&$number) {

                $carry = $carry .= self::ROW_START
                    . $number
                    .self::ROW_MIDDLE
                    . $row
                    . self::ROW_END;

                $number++;

                return $carry;
            }, self::HTML_START) . self::TABLE_END;

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
            $footer .= "</a>";
        }

        return $footer .= self::FOOTER_END;
    }
}
