<?php

declare(strict_types=1);

namespace Idiosyncratic\EditorConfig\Declaration;

use DomainException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class CharsetTest extends TestCase
{
    public function testValidValues()
    {
        foreach (Charset::CHARSETS as $charset) {
            $declaration = new Charset($charset);
            $this->assertEquals(sprintf('charset=%s', $charset), (string) $declaration);
        }
    }

    public function testInvalidValueType()
    {
        $this->expectException(DomainException::class);
        $declaration = new Charset(true);
    }

    public function testInvalidValueValue()
    {
        $this->expectException(DomainException::class);
        $declaration = new Charset('spaces');
    }
}
