<?php

declare(strict_types=1);

namespace Idiosyncratic\EditorConfig\Declaration;

final class GenericDeclaration extends Declaration
{
    /**
     * @param mixed $value
     */
    public function __construct(string $name, $value)
    {
        $this->setName($name);

        parent::__construct($value);
    }
}
