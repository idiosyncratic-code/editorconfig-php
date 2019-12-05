<?php

declare(strict_types=1);

namespace Idiosyncratic\EditorConfig\Declaration;

final class UnsetDeclaration extends Declaration
{
    public function __construct(string $name)
    {
        $this->setName($name);

        parent::__construct(null);
    }

    public function getStringValue() : string
    {
        return 'unset';
    }
}
