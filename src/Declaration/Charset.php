<?php

declare(strict_types=1);

namespace Idiosyncratic\EditorConfig\Declaration;

use DomainException;
use function in_array;
use function is_string;
use function sprintf;

final class Charset extends Declaration
{
    public const CHARSETS = [
        'latin1',
        'utf-8',
        'utf-8-bom',
        'utf-16be',
        'utf-16le',
    ];

    /**
     * @inheritdoc
     */
    public function validateValue($value) : void
    {
        if (is_string($value) === false || in_array($value, self::CHARSETS) === false) {
            throw new DomainException(sprintf('%s is not a valid value for \'%s\'', $value, $this->getName()));
        }
    }

    public function getName() : string
    {
        return 'charset';
    }
}
