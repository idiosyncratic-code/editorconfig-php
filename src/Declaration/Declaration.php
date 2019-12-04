<?php

declare(strict_types=1);

namespace Idiosyncratic\EditorConfig\Declaration;

use function sprintf;

abstract class Declaration
{
    abstract public function getName() : string;

    /**
     * @return mixed
     */
    abstract public function getValue();

    abstract public function getStringValue() : string;

    public function __toString() : string
    {
        return sprintf('%s=%s', $this->getName(), $this->getStringValue());
    }
}
