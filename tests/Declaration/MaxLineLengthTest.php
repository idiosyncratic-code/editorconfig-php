<?php

declare(strict_types=1);

namespace Idiosyncratic\EditorConfig\Declaration;

use DomainException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class MaxLineLengthTest extends TestCase
{
    public function testValidValues()
    {
        $declaration = new MaxLineLength('off');
        $this->assertEquals('max_line_length=off', (string) $declaration);

        $declaration = new MaxLineLength(4);
        $this->assertEquals('max_line_length=4', (string) $declaration);
    }

    public function testInvalidValueType()
    {
        $this->expectException(DomainException::class);
        $declaration = new MaxLineLength(true);
    }

    public function testInvalidValueValue()
    {
        $this->expectException(DomainException::class);
        $declaration = new MaxLineLength('four');
    }

    public function testInvalidNegativeIntegerValue()
    {
        $this->expectException(DomainException::class);
        $declaration = new MaxLineLength(-1);
    }
}
