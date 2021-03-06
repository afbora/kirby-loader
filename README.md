# Kirby Loader

The Kirby Loader allows you to install plugins from multiple root directories. You can easily manage plug-ins by grouping them.

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
        // register string paths
        '/plugins/core',
        '/plugins/payment',
        '/plugins/shipping',
        
        // register single directory
        '/theme',
        
        // register with callback
        function () {
            return option('custom.option.path');
        },
    ]
];

```

## Options

The default values of the package are:

| Option | Default | Values | Description |
|:---|:---|:---|:---|
| afbora.loader.roots | [] | (array) | Array with the roots |

All the values can be updated in the `config.php` file.
