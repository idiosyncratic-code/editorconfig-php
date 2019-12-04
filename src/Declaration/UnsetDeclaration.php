<?php

declare(strict_types=1);

namespace Idiosyncratic\EditorConfig\Declaration;

class UnsetDeclaration extends Declaration
{
    private $name;

    public function __construct(string $name)
    {
        $this->name = strtolower($name);
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
        return null;
    }

    public function getStringValue() : string
    {
        return 'unset';
    }
}
