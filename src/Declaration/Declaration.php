<?php

declare(strict_types=1);

namespace Idiosyncratic\EditorConfig\Declaration;

use function is_bool;
use function sprintf;
use function strtolower;

abstract class Declaration
{
    /** @var string */
    private $name;

    /** @var mixed */
    private $value;

    /**
     * @param mixed $value
     */
    public function __construct($value)
    {
        $this->setValue($value);
    }

    public function getName() : string
    {
        return $this->name;
    }

    protected function setName(string $name) : void
    {
        $this->name = strtolower($name);
    }

    /**
     * @param mixed $value
     */
    protected function setValue($value) : void
    {
        $this->validateValue($value);

        $this->value = $value;
    }

    /**
     * @return mixed
     */
    public function getValue()
    {
        return $this->value;
    }

    public function getStringValue() : string
    {
        if (is_bool($this->value)) {
            return $this->value === true ? 'true' : 'false';
        }

        return (string) $this->value;
    }

    public function __toString() : string
    {
        return sprintf('%s=%s', $this->getName(), $this->getStringValue());
    }

    /**
     * @param mixed $value
     */
    public function validateValue($value) : void
    {
        return;
    }
}
