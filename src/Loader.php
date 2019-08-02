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

    protected function pluginsLoader(string $root): void
    {
        if ($this->readDir(basename($root), dirname($root)) === false) {
            foreach (Dir::read($root) as $dirname) {
                $this->readDir($dirname, $root);
            }
        }
    }

    protected function readDir(string $dirname, string $root): bool
    {
        if (in_array(substr($dirname, 0, 1), ['.', '_']) === true) {
            return false;
        }
        $dir = $root . DIRECTORY_SEPARATOR . $dirname;
        if (is_dir($dir) === false) {
            return false;
        }
        $entry = $dir . DIRECTORY_SEPARATOR . 'index.php';
        if (file_exists($entry) === false) {
            return false;
        }
        include_once $entry;
        return true;
    }
}
