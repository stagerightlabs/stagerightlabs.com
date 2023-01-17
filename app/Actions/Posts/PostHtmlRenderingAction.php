<?php

namespace App\Actions\Posts;

use App\Post;
use League\CommonMark\CommonMarkConverter;
use StageRightLabs\Actions\Action;

class PostHtmlRenderingAction extends Action
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

        $markdown = new CommonMarkConverter();

        // Render the post as HTML; both a 'full' version and a 'simple' version
        $content = PostMarkdownRenderingAction::execute(['post' => $this->post]);
        if ($content->failed()) {
            return $content;
        }
        $this->rendered = $markdown->convert($content->rendered);
        $this->simple = $markdown->convert($content->simple);

        return $this->complete("Post {$input['post']->reference_id} content has been rendered.");
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
