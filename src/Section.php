<?php

declare(strict_types=1);

namespace Idiosyncratic\EditorConfig;

use ErrorException;
use function debug_backtrace;
use function fnmatch;
use function sprintf;
use function strtolower;

final class Section
{
    /** @var string */
    private $glob;

    /** @var array<string, mixed> */
    private $properties = [];

    /**
     * @param array<string, mixed> $properties
     */
    public function __construct(string $glob, array $properties)
    {
        $this->glob = $glob;

        $this->setProperties($properties);
    }

    /**
     * @return array<string, mixed>
     */
    public function getProperties() : array
    {
        return $this->properties;
    }

    public function matches(string $path) : bool
    {
        return fnmatch($this->glob, $path);
    }

    private function setProperties(array $properties) : void
    {
        foreach ($properties as $name => $value) {
            $this->setProperty($name, $value);
        }
    }

    /**
     * @param mixed $value
     */
    private function setProperty(string $name, $value) : void
    {
        if ($value === 'unset') {
            $value = null;
        }

        $this->properties[strtolower($name)] = $value;
    }

    /**
     * @return mixed
     */
    public function __get(string $property)
    {
        if (isset($this->properties[$property]) === true) {
            return $this->properties[$property];
        }

        $trace = debug_backtrace();

        throw new ErrorException(sprintf(
            'Undefined property: %s in %s on line %s',
            $property,
            $trace[0]['file'],
            $trace[0]['line']
        ));
    }
}
