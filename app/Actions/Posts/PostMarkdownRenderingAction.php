<?php

namespace App\Actions\Posts;

use App\Actions\Complete;
use App\Actions\Failure;
use App\Actions\Reaction;
use App\Post;
use App\Snippet;
use App\Utilities\Arr;
use App\Utilities\Str;
use League\CommonMark\CommonMarkConverter;
use StageRightLabs\Actions\Action;

class PostMarkdownRenderingAction extends Action
{
    /**
     * @var Post
     */
    public $post;

    /**
     * @var string
     */
    public $rendered;

    /**
     * Convert the contents of a post to html.
     *
     * @param Action|array $input
     * @return self
     */
    public function handle($input = [])
    {
        $this->post = $input['post'];

        if (empty($input['post']->content)) {
            return $this->fail("Post {$input['post']->reference_id} has no content to render.");
        }

        $this->rendered = $this->replaceShortcodes(
            $input['post']->content,
            $input['post']->shortcodes
        );

        return $this->complete("Post {$input['post']->reference_id} content has been rendered.");
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
            ->reduce(function ($content, $snippet) {
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
            ->filter(function ($shortcode) {
                return Str::startsWith($shortcode['code'], 'Snippet ');
            })->map(function ($shortcode) {
                return Str::after($shortcode['code'], 'Snippet ');
            });

        return Snippet::whereIn('reference_id', $referenceIds)->get();
    }

    /**
     * The input keys required by this action.
     *
     * @return array
     */
    public function required()
    {
        return [
            'post'
        ];
    }
}
