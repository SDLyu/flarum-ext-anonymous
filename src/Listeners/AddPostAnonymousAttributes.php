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
            $event->attributes['username'] = $this->settings->get('flarum-anonymous.forum.anonymous', 'local');
            $event->attributes['email'] = null;
        }
    }
}
