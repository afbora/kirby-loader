<?php

use Afbora\Loader;
use Kirby\Cms\App as Kirby;

load([
    'afbora\\loader' => __DIR__ . '/src/Loader.php',
]);

(new Loader())->register();

Kirby::plugin('afbora/loader', [
    'options' => [
        'roots' => []
    ]
]);
