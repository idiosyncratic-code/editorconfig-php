<?php

declare(strict_types=1);

namespace Idiosyncratic\EditorConfig;

use PHPUnit\Framework\TestCase;
use RuntimeException;

class EditorConfigFileTest extends TestCase
{
    public function testParseEditorConfigFile() : void
    {
        $path = __DIR__ . '/data/editorconfig';

        $file = new EditorConfigFile($path);

        $this->assertInstanceOf(EditorConfigFile::class, $file);

        $this->assertFalse($file->isRoot());

        $this->assertEquals($path, $file->getPath());
    }

    public function testGetPath() : void
    {
        $path = __DIR__ . '/data/editorconfig';

        $file = new EditorConfigFile($path);

        $this->assertEquals($path, $file->getPath());
    }

    public function testEmptyFile() : void
    {
        $path = __DIR__ . '/data/empty_editorconfig';

        $file = new EditorConfigFile($path);

        $this->assertEquals('', trim((string) $file));
    }

    public function testRootFile() : void
    {
        $path = __DIR__ . '/data/root_editorconfig';

        $file = new EditorConfigFile($path);

        $this->assertTrue($file->isRoot());

        $this->assertTrue(strpos((string) $file, 'root=true') === 0);
    }

    public function testFileDoesNotExist() : void
    {
        $this->expectException(RuntimeException::class);

        $file = new EditorConfigFile(__DIR__);
    }

    public function testGetConfigForPath() : void
    {
        $path = __DIR__ . '/data/editorconfig';

        $file = new EditorConfigFile($path);

        $config = $file->getConfigForPath(__DIR__);

        $this->assertFalse(isset($config['indent_size']));

        $config = $file->getConfigForPath(__FILE__);

        $this->assertEquals(4, $config['indent_size']->getValue());
    }
}
