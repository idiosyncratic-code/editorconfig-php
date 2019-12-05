<?php

declare(strict_types=1);

namespace Idiosyncratic\EditorConfig\Declaration;

use DomainException;
use function is_bool;
use function sprintf;

final class TrimTrailingWhitespace extends Declaration
{
    public function getName() : string
    {
        return 'trim_trailing_whitespace';
    }

    /**
     * @inheritdoc
     */
    public function validateValue($value) : void
    {
        if (is_bool($value) === false) {
            throw new DomainException(sprintf('%s is not a valid value for \'%s\'', $value, $this->getName()));
        }
    }
}
