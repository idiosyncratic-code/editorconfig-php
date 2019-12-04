<?php

declare(strict_types=1);

namespace Idiosyncratic\EditorConfig;

use const DIRECTORY_SEPARATOR;
use function array_merge;
use function array_pop;
use function dirname;
use function is_file;
use function is_readable;
use function realpath;
use function sprintf;

final class EditorConfig
{
    /** @var array<string, EditorConfigFile> */
    private $configFiles = [];

    /**
     * @return array<string, mixed>
     */
    public function getConfigForPath(string $path) : array
    {
        $configFiles = $this->locateConfigFiles($path);

        $root = false;

        $configuration = [];

        $configFile = array_pop($configFiles);

        while ($configFile !== null) {
            $configuration = array_merge($configuration, $configFile->getConfigForPath($path));
            $configFile = array_pop($configFiles);
        }

        foreach ($configuration as $key => $declaration) {
            if ($declaration->getValue() === null) {
                unset($configuration[$key]);
            }
        }

        return $configuration;
    }

    /**
     * @return array<EditorConfigFile>
     */
    private function locateConfigFiles(string $path) : array
    {
        $files = [];

        $stop = false;

        while (true) {
            $editorConfigFile = realpath(sprintf('%s%s.editorconfig', $path, DIRECTORY_SEPARATOR));

            if ($editorConfigFile !== false && is_file($editorConfigFile) && is_readable($editorConfigFile)) {
                $file = $this->getConfigFile($editorConfigFile);

                $files[] = $file;

                if ($file->isRoot() === true) {
                    break;
                }
            }

            $parent = dirname($path);

            if ($parent === $path) {
                break;
            }

            $path = $parent;
        }

        return $files;
    }

    private function getConfigFile(string $path) : EditorConfigFile
    {
        return $this->configFiles[$path] ?? $this->configFiles[$path] = new EditorConfigFile($path);
    }
}
