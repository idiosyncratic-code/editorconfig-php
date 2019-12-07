<?php

declare(strict_types=1);

namespace Idiosyncratic\EditorConfig\Declaration;

use function in_array;
use function is_numeric;
use function sprintf;
use function strtolower;

abstract class Declaration
{
    /** @var string */
    private $name;

    /** @var string */
    private $stringValue;

    /** @var mixed */
    private $value;

    public function __construct(string $value)
    {
        $typedValue = $this->getTypedValue($value);

        $this->setStringValue($value);

        $this->validateValue($typedValue);

        $this->setValue($typedValue);
    }

    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    final public function getValue()
    {
        return $this->value;
    }

    final public function getStringValue() : string
    {
        return $this->stringValue;
    }

    /**
     * @param mixed $value
     */
    public function validateValue($value) : void
    {
        return;
    }

    final public function __toString() : string
    {
        return sprintf('%s=%s', $this->getName(), $this->getStringValue());
    }

    protected function setName(string $name) : void
    {
        $this->name = strtolower($name);
    }

    /**
     * @return mixed
     */
    protected function getTypedValue(string $value)
    {
        if (in_array($value, ['true', 'false']) === true) {
            return $value === 'true';
        }

        if (is_numeric($value) === true && (string) (int) $value === $value) {
            return (int) $value;
        }

        return $value;
    }

    final protected function setStringValue(string $value) : void
    {
        $this->stringValue = $value;
    }

    /**
     * @param mixed $value
     */
    final protected function setValue($value) : void
    {
        $this->value = $value;
    }
}
