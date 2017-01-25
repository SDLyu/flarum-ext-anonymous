<?php

use Illuminate\Database\Schema\Blueprint;
use Flarum\Migrations\Migration;

return Migration::addColumns('posts', [
    'is_anonymous' => ['boolean', 'default' => 1]
]);
