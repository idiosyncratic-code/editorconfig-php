<?php

declare(strict_types=1);

namespace Idiosyncratic\EditorConfig\Declaration;

use Idiosyncratic\EditorConfig\Exception\InvalidValue;

use function is_int;

final class MaxLineLength extends Declaration
{
    public function getName() : string
    {
        return 'max_line_length';
    }

    /**
     * @inheritdoc
     */
    public function validateValue($value) : void
    {
        if ($value !== 'off' && (is_int($value) === false || $value < 1 === true)) {
            throw new InvalidValue(
                $this->getStringValue(),
                $this->getName()
            );
        }
    }
}
