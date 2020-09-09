<?php

namespace App\Actions\Posts;

use App\Actions\Complete;
use App\Actions\Failure;
use App\Actions\Reaction;
use App\Snippet;
use App\Utilities\Arr;
use App\Utilities\Str;
use League\CommonMark\CommonMarkConverter;

/**
 * Convert the contents of a post to html.
 *
 * Expected Input:
 *  - 'post' (Post)
 */
class PostRenderingAction
{
    /**
     * Execute the action.
     *
     * @param array $data
     * @return Reaction
     */
    public function execute($data = [])
    {
        if ($missing = Arr::disclose($data, ['post'])) {
            return new Failure("Missing expected '{$missing[0]}' value.");
        }

        if (empty($data['post']->content)) {
            return new Failure("Post {$data['post']->reference_id} has no content to render.", [
                'post' => $data['post'],
            ]);
        }

        $content = $this->replaceShortcodes($data['post']->content, $data['post']->shortcodes);

        $converter = new CommonMarkConverter();
        $rendered = $converter->convertToHtml($content);

        return new Complete("Post {$data['post']->reference_id} content has been rendered.", [
            'post' => $data['post'],
            'rendered' => $rendered,
        ]);
    }

    /**
     * Replace shortcodes with their rendered output.
     *
     * @param string $content
     * @param Collection $shortcodes
     * @return string
     */
    protected function replaceShortcodes($content, $shortcodes)
    {
        return $this->fetchSnippets($shortcodes)
            ->reduce(function($content, $snippet) {
                return str_replace(
                    $snippet->shortcode,
                    $snippet->rendered,
                    $content
                );
            }, $content ?? '');
    }

    /**
     * Fetch snippet content from the database.
     *
     * @param Collection $shortcodes
     * @return Collection
     */
    protected function fetchSnippets($shortcodes)
    {
        $referenceIds = $shortcodes
            ->filter(function($shortcode) {
                return Str::startsWith($shortcode['code'], 'Snippet ');
            })->map(function($shortcode) {
                return Str::after($shortcode['code'], 'Snippet ');
            });

        return Snippet::whereIn('reference_id', $referenceIds)->get();
    }
}
