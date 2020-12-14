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

        $markdown = PostMarkdownRenderingAction::execute(['post' => $this->post]);

        if ($markdown->failed()) {
            return $markdown;
        }

        $this->rendered = (new CommonMarkConverter())->convertToHtml($markdown->rendered);

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
            'post'
        ];
    }
}
