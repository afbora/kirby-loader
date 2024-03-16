<?php

namespace Afbora;

use Kirby\Cms\App;
use Kirby\Filesystem\Dir;
use Kirby\Filesystem\F;

class Loader
{
    protected $roots = [];

    public function __construct()
    {
        $this->roots = option('afbora.loader.roots', []);
    }

    public function register(): void
    {
        if (empty($this->roots) === false) {
            foreach ($this->roots as $root) {
                if (is_string($root) === true) {
                    $root = $this->getRootPath($root);
                } elseif (is_a($root, 'Closure') === true) {
                    $root = $this->getRootPath($root());
                } else {
                    // not supported type
                    continue;
                }

                $this->pluginsLoader($root);
            }
        }
    }

    protected function pluginsLoader(string $root): void
    {
        // check and register directly plugin directory
        $singlePluginRegister = $this->readDir($root);

        // read directory and register all plugins in given path
        if ($singlePluginRegister === false) {
            foreach (Dir::read($root, null, true) as $path) {
                $this->readDir($path);
            }
        }
    }

    protected function readDir(string $root = null): bool
    {
        if (empty($root) === true|| in_array(substr(basename($root), 0, 1), ['.', '..']) === true) {
            return false;
        }

        if (is_dir($root) === false) {
            return false;
        }

        $dirname = basename($root);

        $entry = $root . DIRECTORY_SEPARATOR . 'index.php';
        $script = $root . DIRECTORY_SEPARATOR . 'index.js';
        $styles = $root . DIRECTORY_SEPARATOR . 'index.css';

        if (is_dir($root) === true && is_file($entry) === true) {
            F::loadOnce($entry, false);
        } elseif (is_file($script) === true || is_file($styles) === true) {
            App::plugin('plugins/' . $dirname, ['root' => $root]);
        } else {
            return false;
        }


        return true;
    }

    protected function getRootPath(string $root = null): string
    {
        $index = kirby()->root();

        if (is_dir($root) === false && strpos($root, $index) === false) {
            $root = $index . DIRECTORY_SEPARATOR . ltrim($root, DIRECTORY_SEPARATOR);
        }

        return $root;
    }
}
