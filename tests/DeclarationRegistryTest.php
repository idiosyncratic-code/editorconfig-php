<?php

declare(strict_types=1);

namespace Idiosyncratic\EditorConfig;

use DomainException;
use Idiosyncratic\EditorConfig\Declaration\GenericDeclaration;
use Idiosyncratic\EditorConfig\Declaration\UnsetDeclaration;
use PHPUnit\Framework\TestCase;
use RuntimeException;

class DeclarationRegistryTest extends TestCase
{
    public function testOfficialDeclarations()
    {
        $declarations = [
            'indent_style' => 'space',
            'indent_size' => 4,
            'tab_width' => 4,
            'end_of_line' => 'lf',
            'charset' => 'utf-8',
            'trim_trailing_whitespace' => true,
            'insert_final_newline' => false,
            'max_line_length' => 'off',
        ];

        $registry = new DeclarationRegistry();

        foreach ($declarations as $key => $value) {
            $declaration = $registry->getDeclaration($key, $value);
            $this->assertEquals($key, $declaration->getName());
        }
    }

    public function testUnsetDeclaration()
    {
        $registry = new DeclarationRegistry();

        $indentSize = $registry->getDeclaration('indent_size', 'unset');

        $this->assertInstanceOf(UnsetDeclaration::class, $indentSize);
    }

    public function testUnknownDeclaration()
    {
        $registry = new DeclarationRegistry();

        $justification = $registry->getDeclaration('justification', 'left');

        $this->assertInstanceOf(GenericDeclaration::class, $justification);
    }
}
