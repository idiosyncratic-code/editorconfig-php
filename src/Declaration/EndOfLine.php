<?php

declare(strict_types=1);

namespace Idiosyncratic\EditorConfig\Declaration;

use Idiosyncratic\EditorConfig\Exception\InvalidValue;
use function in_array;

final class EndOfLine extends Declaration
{
    public const LINE_ENDINGS = [
        'lf',
        'cr',
        'crlf',
    ];

    /**
     * @inheritdoc
     */
    public function validateValue($value) : void
    {
        if (in_array($value, self::LINE_ENDINGS) === false) {
            throw new InvalidValue(
                $this->getStringValue(),
                $this->getName()
            );
        }
    }

    public function getName() : string
    {
        return 'end_of_line';
    }
}
