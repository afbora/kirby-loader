<?php

namespace Afbora\Loader;

use Kirby\Toolkit\Dir;

class Loader
{
    protected $roots = [];

    public function __construct()
    {
        $this->roots = option('afbora.loader.roots');
    }

    public function register()
    {
        if ($this->roots) {
            $index = kirby()->root('index');
            foreach ($this->roots as $root) {
                if (is_string($root)) {
                    if (strpos($root, $index) === false) {
                        $root = $index . DIRECTORY_SEPARATOR . ltrim($root, DIRECTORY_SEPARATOR);
                    }
                    $this->pluginsLoader($root);
                }
            }
        }
    }

    protected function pluginsLoader(string $root): array
    {
        $loaded = [];
        foreach (Dir::read($root) as $dirname) {
            if (in_array(substr($dirname, 0, 1), ['.', '_']) === true) {
                continue;
            }
            if (is_dir($root . '/' . $dirname) === false) {
                continue;
            }
            $dir = $root . '/' . $dirname;
            $entry = $dir . '/index.php';
            if (file_exists($entry) === false) {
                continue;
            }
            include_once $entry;
            $loaded[] = $dir;
        }
        return $loaded;
    }
}
