<?php

declare(strict_types=1);

namespace Idiosyncratic\EditorConfig\Declaration;

final class UnsetDeclaration extends Declaration
{
    public function __construct(string $name)
    {
        $this->setName($name);

        parent::__construct('unset');
    }

    /**
     * @return mixed
     */
    protected function getTypedValue(string $value)
    {
        return null;
    }
}
