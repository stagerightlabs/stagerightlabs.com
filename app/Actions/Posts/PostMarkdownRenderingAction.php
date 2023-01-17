<?php

namespace App\Actions\Posts;

use App\Post;
use App\Snippet;
use App\Utilities\Str;
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
     * @var string
     */
    public $simple;

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

        $this->rendered = $this->replaceShortCodes(
            $input['post']->content,
            $input['post']->shortcodes
        );

        $this->simple = $this->replaceShortCodes(
            $input['post']->content,
            $input['post']->shortcodes,
            $useSimpleMarkdown = true
        );

        return $this->complete("Post {$input['post']->reference_id} content has been rendered.");
    }

    /**
     * Replace shortcodes with their rendered output.
     *
     * @param string $content
     * @param Collection $shortCodes
     * @param bool $useSimpleMarkdown
     * @return string
     */
    protected function replaceShortCodes($content, $shortCodes, $useSimpleMarkdown = false)
    {
        return $this->fetchSnippets($shortCodes)
            ->reduce(function ($content, $snippet) use ($useSimpleMarkdown) {
                $replace = $useSimpleMarkdown
                    ? $snippet->markdown
                    : $snippet->rendered;

                return str_replace($snippet->shortcode, $replace, $content);
            }, $content ?? '');
    }

    /**
     * Fetch snippet content from the database.
     *
     * @param Collection $shortCodes
     * @return Collection
     */
    protected function fetchSnippets($shortCodes)
    {
        $referenceIds = $shortCodes
            ->filter(function ($shortCode) {
                return Str::startsWith($shortCode['code'], 'Snippet ');
            })->map(function ($shortCode) {
                return Str::after($shortCode['code'], 'Snippet ');
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
            'post',
        ];
    }
}
