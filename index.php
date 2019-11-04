<?php

use Afbora\Loader\Loader;
use Kirby\Cms\App as Kirby;

@include_once __DIR__ . "/vendor/autoload.php";

(new Loader())->register();

Kirby::plugin('afbora/loader', [
    'options' => [
        'roots' => []
    ]
]);