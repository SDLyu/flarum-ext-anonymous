<?php namespace Sdlyu\Anonymous\Listeners;

use Flarum\Event\PrepareApiAttributes;
use Flarum\Api\Serializer\UserSerializer;
use Illuminate\Contracts\Events\Dispatcher;

class AddPostAnonymousAttributes
{
    private $settings;

    public function subscribe(Dispatcher $events)
    {
        $events->listen(PrepareApiAttributes::class, [$this, 'prepareApiAttributes']);
    }

    public function prepareApiAttributes(PrepareApiAttributes $event)
    {
        if ($event->isSerializer(UserSerializer::class)) {
            $event->attributes['username'] = app('translator')->trans('flarum-anonymous.forum.anonymous');
            $event->attributes['email'] = null;
        }
    }
}
