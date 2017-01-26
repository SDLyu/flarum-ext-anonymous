<?php namespace Sdlyu\Anonymous\Listener;

use Flarum\Core\Access\AssertPermissionTrait;
use Flarum\Event\PostWillBeSaved;
use Illuminate\Contracts\Events\Dispatcher;

class SaveAnonymousToDatabase
{
    use AssertPermissionTrait;
    /**
     * @param Dispatcher $events
     */
    public function subscribe(Dispatcher $events)
    {
        $events->listen(PostWillBeSaved::class, [$this, 'whenPostWillBeSaved']);
    }
    /**
     * @param PostWillBeSaved $event
     */
    public function whenPostWillBeSaved(PostWillBeSaved $event)
    {
        $post = $event->post;
        $data = $event->data;

        if ($post->exists && isset($data['attributes']['isAnonymous'])) {
            $post->is_anonymous = $data['attributes']['isAnonymous'];
            $post->save();
        }
    }
}
