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
    /**
     * @return array<string, mixed>
     */
    public static function getConfigForPath(string $path) : array
    {
        $configFiles = self::locateConfigFiles($path);

        $root = false;

        $configuration = [];

        $configFile = array_pop($configFiles);

        while ($configFile !== null) {
            $configuration = array_merge($configuration, $configFile->getConfigForPath($path));
            $configFile = array_pop($configFiles);
        }

        foreach ($configuration as $property => $value) {
            if ($value !== null) {
                continue;
            }

            unset($configuration[$property]);
        }

        return $configuration;
    }

    /**
     * @return array<EditorConfigFile>
     */
    private static function locateConfigFiles(string $path) : array
    {
        $files = [];

        $stop = false;

        while ($stop !== true) {
            $editorConfig = realpath(sprintf('%s%s.editorconfig', $path, DIRECTORY_SEPARATOR));

            if ($editorConfig !== false && is_file($editorConfig) && is_readable($editorConfig)) {
                $file = new EditorConfigFile($editorConfig);
                $files[] = $file;
                if ($file->isRoot() === true) {
                    $stop = true;
                }
            }

            $parent = dirname($path);

            if ($parent === $path) {
                $stop = true;
            }

            $path = $parent;
        }

        return $files;
    }
}
