<?php

declare(strict_types=1);

namespace Idiosyncratic\EditorConfig\Declaration;

use DomainException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class TabWidthTest extends TestCase
{
    public function testValidValues()
    {
        $declaration = new TabWidth(4);
        $this->assertEquals('tab_width=4', (string) $declaration);
    }

    public function testInvalidValueType()
    {
        $this->expectException(DomainException::class);
        $declaration = new TabWidth(true);
    }

    public function testInvalidValueValue()
    {
        $this->expectException(DomainException::class);
        $declaration = new TabWidth('four');
    }

    public function testNegativeIntegerValue()
    {
        $this->expectException(DomainException::class);
        $declaration = new TabWidth(-1);
    }
}
