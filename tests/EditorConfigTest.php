<?php

declare(strict_types=1);

namespace Idiosyncratic\EditorConfig;

use PHPUnit\Framework\TestCase;
use RuntimeException;

class EditorConfigTest extends TestCase
{
    public function testResolvingConfigForPath() : void
    {
        $ec = new EditorConfig();

        $config = $ec->getConfigForPath(__FILE__);

        $this->assertEquals(4, $config['indent_size']->getValue());

        $config = $ec->printConfigForPath(__DIR__ . '/data/testfile.php');

        $this->assertFalse(strpos($config, 'indent_size=4'));
    }
}
