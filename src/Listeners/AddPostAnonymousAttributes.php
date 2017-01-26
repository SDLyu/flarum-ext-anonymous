<?php namespace Sdlyu\Anonymous\Listeners;

use Flarum\Event\PrepareApiAttributes;
use Flarum\Api\Serializer\UserSerializer;
use Flarum\Api\Serializer\UserBasicSerializer;
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
        $model = $event->model;

        if ($event->isSerializer(UserSerializer::class) || $event->isSerializer(UserBasicSerializer::class)) {
            $event->attributes['username'] = app('translator')->trans('flarum-anonymous.forum.anonymous') . $model['id'];
            $event->attributes['email'] = null;
        }
    }
}
