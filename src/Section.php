<?php

declare(strict_types=1);

namespace Idiosyncratic\EditorConfig;

use ErrorException;
use function debug_backtrace;
use function fnmatch;
use function sprintf;

final class Section
{
    /** @var string */
    private $glob;

    /** @var array<string, mixed> */
    private $declarations = [];

    /** @var DeclarationRegistry */
    private $declarationRegistry;

    /**
     * @param array<string, mixed> $declarations
     */
    public function __construct(string $glob, array $declarations, DeclarationRegistry $declarationRegistry)
    {
        $this->glob = $glob;

        $this->declarationRegistry = $declarationRegistry;

        $this->setDeclarations($declarations);
    }

    /**
     * @return array<string, mixed>
     */
    public function getDeclarations() : array
    {
        return $this->declarations;
    }

    public function matches(string $path) : bool
    {
        return fnmatch($this->glob, $path);
    }

    /**
     * @param array<string, mixed> $declarations
     */
    private function setDeclarations(array $declarations) : void
    {
        foreach ($declarations as $name => $value) {
            $this->setDeclaration($name, $value);
        }
    }

    /**
     * @param mixed $value
     */
    private function setDeclaration(string $name, $value) : void
    {
        $declaration = $this->declarationRegistry->getDeclaration($name, $value);

        $this->declarations[$declaration->getName()] = $declaration;
    }

    /**
     * @return mixed
     */
    public function __get(string $property)
    {
        if (isset($this->declarations[$property]) === true) {
            return $this->declarations[$property];
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
