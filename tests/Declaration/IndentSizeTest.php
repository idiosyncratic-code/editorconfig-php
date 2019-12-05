<?php

declare(strict_types=1);

namespace Idiosyncratic\EditorConfig\Declaration;

use DomainException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class IndentSizeTest extends TestCase
{
    public function testValidValues()
    {
        $declaration = new IndentSize('tab');
        $this->assertEquals('indent_size=tab', (string) $declaration);

        $declaration = new IndentSize(4);
        $this->assertEquals('indent_size=4', (string) $declaration);
    }

    public function testInvalidValueType()
    {
        $this->expectException(DomainException::class);
        $declaration = new IndentSize(true);
    }

    public function testInvalidValueValue()
    {
        $this->expectException(DomainException::class);
        $declaration = new IndentSize('four');
    }

    public function testInvalidNegativeIntegerValue()
    {
        $this->expectException(DomainException::class);
        $declaration = new IndentSize(-1);
    }
}
