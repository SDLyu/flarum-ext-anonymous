<?php

use Illuminate\Contracts\Events\Dispatcher;

use Sdlyu\Anonymous\Listeners;

return function (Dispatcher $events) {
    $events->subscribe(Listener\AddClientAssets::class);
};
