<?php

declare(strict_types=1);

namespace Idiosyncratic\EditorConfig\Declaration;

use Idiosyncratic\EditorConfig\Exception\InvalidValue;
use PHPUnit\Framework\TestCase;

class MaxLineLengthTest extends TestCase
{
    public function testValidValues()
    {
        $declaration = new MaxLineLength('off');
        $this->assertEquals('max_line_length=off', (string) $declaration);

        $declaration = new MaxLineLength('4');
        $this->assertEquals('max_line_length=4', (string) $declaration);
        $this->assertSame(4, $declaration->getValue());
    }

    public function testInvalidValues()
    {
        $this->expectException(InvalidValue::class);
        $declaration = new MaxLineLength('true');

        $this->expectException(InvalidValue::class);
        $declaration = new MaxLineLength('four');

        $this->expectException(InvalidValue::class);
        $declaration = new MaxLineLength('-1');
    }
}
