<?php namespace Sdlyu\Anonymous\Listeners;

use Flarum\Event\PrepareApiAttributes;
use Flarum\Api\Serializer\PostSerializer;
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
        if ($event->isSerializer(PostSerializer::class)) {
            $event->attributes['isAnonymous'] = (bool) $event->model->is_anonymous;
        }
    }
}
