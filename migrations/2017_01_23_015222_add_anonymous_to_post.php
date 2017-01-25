<?php

use Illuminate\Database\Schema\Blueprint;
use Flarum\Database\Migration;

return Migration::addColumns('posts', [
    'is_anonymous' => ['boolean', 'default' => 1]
]);
