<?php

declare(strict_types=1);

namespace Idiosyncratic\EditorConfig\Declaration;

class GenericDeclaration extends Declaration
{
    /** @var string */
    private $name;

    /** @var mixed */
    private $value;

    public function __construct(string $name, $value)
    {
        $this->name = strtolower($name);
        $this->value = $value;
    }

    public function getName() : string
    {
        return $this->name;
    }

    /**
     * @inheritdoc
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
}
