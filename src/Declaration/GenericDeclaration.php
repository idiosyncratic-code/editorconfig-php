<?php

declare(strict_types=1);

namespace Idiosyncratic\EditorConfig\Declaration;

final class GenericDeclaration extends Declaration
{
    public function __construct(string $name, string $value)
    {
        $this->setName($name);

        parent::__construct($value);
    }
}
