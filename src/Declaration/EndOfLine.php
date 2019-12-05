<?php

declare(strict_types=1);

namespace Idiosyncratic\EditorConfig\Declaration;

use DomainException;
use function in_array;
use function is_string;
use function sprintf;

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
        if (is_string($value) === false || in_array($value, self::LINE_ENDINGS) === false) {
            throw new DomainException(sprintf('%s is not a valid value for \'%s\'', $value, $this->getName()));
        }
    }

    public function getName() : string
    {
        return 'end_of_line';
    }
}
