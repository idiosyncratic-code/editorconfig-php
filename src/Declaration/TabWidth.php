<?php

declare(strict_types=1);

namespace Idiosyncratic\EditorConfig\Declaration;

use DomainException;
use function is_int;
use function sprintf;

final class TabWidth extends Declaration
{
    public function getName() : string
    {
        return 'tab_width';
    }

    /**
     * @inheritdoc
     */
    public function validateValue($value) : void
    {
        if (is_int($value) === false || $value < 1 === true) {
            throw new DomainException(sprintf('%s is not a valid value for \'%s\'', $value, $this->getName()));
        }
    }
}
