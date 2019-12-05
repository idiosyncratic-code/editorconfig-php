<?php

declare(strict_types=1);

namespace Idiosyncratic\EditorConfig\Declaration;

use DomainException;
use ErrorException;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class GenericDeclarationTest extends TestCase
{
    public function testGetName() : void
    {
        $declaration = new GenericDeclaration('declaration', 'string');
        $this->assertEquals('declaration', $declaration->getName());
    }

    public function testGetValue() : void
    {
        $declaration = new GenericDeclaration('declaration', 'string');
        $this->assertIsString($declaration->getValue());
        $this->assertEquals('string', $declaration->getValue());

        $declaration = new GenericDeclaration('declaration', 1);
        $this->assertIsInt($declaration->getValue());
        $this->assertEquals(1, $declaration->getValue());

        $declaration = new GenericDeclaration('declaration', true);
        $this->assertIsBool($declaration->getValue());
        $this->assertTrue($declaration->getValue());

        $declaration = new GenericDeclaration('declaration', 1.1);
        $this->assertIsFloat($declaration->getValue());
        $this->assertEquals(1.1, $declaration->getValue());
    }

    public function testGetStringValue() : void
    {
        $declaration = new GenericDeclaration('declaration', 'string');
        $this->assertEquals('string', $declaration->getStringValue());

        $declaration = new GenericDeclaration('declaration', 1);
        $this->assertEquals('1', $declaration->getStringValue());

        $declaration = new GenericDeclaration('declaration', true);
        $this->assertEquals('true', $declaration->getStringValue());

        $declaration = new GenericDeclaration('declaration', 1.1);
        $this->assertEquals('1.1', $declaration->getStringValue());
    }

    public function testToString() : void
    {
        $declaration = new GenericDeclaration('declaration', 'string');
        $this->assertEquals('declaration=string', (string) $declaration);
    }
}
