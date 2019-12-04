<?php

declare(strict_types=1);

namespace Idiosyncratic\EditorConfig\Declaration;

use DomainException;
use function in_array;
use function sprintf;

class IndentStyle extends Declaration
{
    /** @var string */
    private $value;

    public function __construct(string $value)
    {
        if (in_array($value, ['tab', 'space']) === false) {
            throw new DomainException(sprintf('%s is not a valid value for \'indent_style\'', $value));
        }

        $this->value = $value;
    }

    public function getName() : string
    {
        return 'indent_style';
    }

    /**
     * @inheritdoc
     */
    public function getValue()
    {
        return $this->value;
    }

    public function getStringValue() : string
    {
        return $this->value;
    }
}
