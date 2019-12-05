<?php

declare(strict_types=1);

namespace Idiosyncratic\EditorConfig\Declaration;

use DomainException;
use function is_bool;
use function sprintf;

final class InsertFinalNewline extends Declaration
{
    public function getName() : string
    {
        return 'insert_final_newline';
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
