<?php

declare(strict_types=1);

namespace Idiosyncratic\EditorConfig;

use PHPUnit\Framework\TestCase;
use ErrorException;

class SectionTest extends TestCase
{
    public function testGetDeclaration() : void
    {
        $section = new Section(
            '**/',
            '*.php',
            [
                'indent_size' => 4,
                'indent_style' => 'space',
            ],
            new DeclarationRegistry()
        );

        $this->assertEquals('space', $section->indent_style->getValue());
        $this->assertEquals(4, $section->indent_size->getValue());
        $this->assertFalse(isset($section->tab_width));
    }

    public function testGetMissingDeclaration() : void
    {
        $section = new Section(
            '**/',
            '*.php',
            [
                'indent_size' => 4,
                'indent_style' => 'space',
            ],
            new DeclarationRegistry()
        );

        $this->expectException(ErrorException::class);

        $section->tab_width;
    }
}
