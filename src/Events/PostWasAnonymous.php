<?php namespace Sdlyu\Anonymous\Events;

use Flarum\Core\Discussion;
use Flarum\Core\User;

class DiscussionWasAnonymous
{
    /**
     * @var Post
     */
    public $discussion;
    /**
     * @var User
     */
    public $user;
    /**
     * @param Post $post
     * @param User $user
     */
    public function __construct(Discussion $discussion, User $user)
    {
        $this->discussion = $discussion;
        $this->user = $user;
    }
}
