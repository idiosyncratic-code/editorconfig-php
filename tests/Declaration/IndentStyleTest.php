<?php

declare(strict_types=1);

namespace Idiosyncratic\EditorConfig\Declaration;

use DomainException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class IndentStyleTest extends TestCase
{
    public function testValidValues()
    {
        $declaration = new IndentStyle('tab');
        $this->assertEquals('indent_style', $declaration->getName());
        $this->assertEquals('tab', $declaration->getValue());

        $declaration = new IndentStyle('space');
        $this->assertEquals('indent_style', $declaration->getName());
        $this->assertEquals('space', $declaration->getValue());
    }

    public function testInvalidValueType()
    {
        $this->expectException(DomainException::class);
        $declaration = new IndentStyle(true);
    }

    public function testInvalidValueValue()
    {
        $this->expectException(DomainException::class);
        $declaration = new IndentStyle('spaces');
    }
}
