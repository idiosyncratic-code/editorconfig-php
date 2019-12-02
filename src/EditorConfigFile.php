<?php

declare(strict_types=1);

namespace Idiosyncratic\EditorConfig;

use RuntimeException;
use const INI_SCANNER_TYPED;
use function array_merge;
use function dirname;
use function file_get_contents;
use function is_array;
use function is_file;
use function is_readable;
use function parse_ini_string;
use function preg_replace;
use function sprintf;
use function strpos;

final class EditorConfigFile
{
    /** @var string */
    private $path;

    /** @var string */
    private $fileContent;

    /** @var bool */
    private $isRoot;

    /** @var array<int, Section> */
    private $sections = [];

    public function __construct(string $path)
    {
        if (is_file($path) === false) {
            throw new RuntimeException(sprintf('File %s does not exist', $path));
        }

        if (is_readable($path) === false) {
            throw new RuntimeException(sprintf('File %s is not readable', $path));
        }

        $this->parse($path);
    }

    public function isRoot() : bool
    {
        return $this->isRoot;
    }

    public function getPath() : string
    {
        return $this->path;
    }

    /**
     * @return array<string, mixed>
     */
    public function getConfigForPath(string $path) : array
    {
        $configuration = [];

        foreach ($this->sections as $section) {
            if ($section->matches($path) === false) {
                continue;
            }

            $configuration = array_merge($configuration, $section->getProperties());
        }

        return $configuration;
    }

    private function parse(string $path) : void
    {
        $this->path = $path;

        $fileContent = file_get_contents($path);

        if ($fileContent === false) {
            $this->fileContent = '';

            return;
        }

        $this->fileContent = $fileContent;

        $content =  preg_replace('/^\s/m', '', $this->fileContent) ?? $this->fileContent;

        $parsedContent = parse_ini_string($content, true, INI_SCANNER_TYPED);

        if ($parsedContent === false) {
            return;
        }

        $this->isRoot = $parsedContent['root'] ?? false;

        foreach ($parsedContent as $glob => $properties) {
            if (is_array($properties) === false) {
                continue;
            }

            $globPrefix = strpos($glob, '/') === 0 ? dirname($this->path) : '**/';

            $this->sections[] = new Section(sprintf('%s%s', $globPrefix, $glob), $properties);
        }
    }
}
