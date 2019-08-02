# Kirby Loader

With Kirby Loader you can load plugins from multiple roots. Thus, you can simplify the management of your plugins by grouping.

## Installation

### Installation with composer

```ssh
composer require afbora/kirby-loader
```

### Add as git submodule

```ssh
git submodule add https://github.com/afbora/kirby-loader.git site/plugins/kirby-loader
```

## Usage

```php
<?php

return [
    'afbora.loader.roots' => [
        '/plugins/core',
        '/plugins/payment',
        '/plugins/shipping',
        '/theme', // Register single plugin
    ]
];

```

## Options

The default values of the package are:

| Option | Default | Values | Description |
|:--|:--|:--|:--|
| afbora.loader.roots | [] | (array) | Array with the roots |

All the values can be updated in the `config.php` file.
