<?php

declare(strict_types=1);

namespace Idiosyncratic\EditorConfig;

use Idiosyncratic\EditorConfig\Declaration\Declaration;
use Idiosyncratic\EditorConfig\Declaration\GenericDeclaration;
use Idiosyncratic\EditorConfig\Declaration\IndentStyle;
use Idiosyncratic\EditorConfig\Declaration\UnsetDeclaration;
use function call_user_func_array;
use function method_exists;
use function sprintf;
use function str_replace;
use function ucwords;

final class DeclarationRegistry
{
    /**
     * @param mixed $value
     */
    public function getDeclaration(string $name, $value) : Declaration
    {
        if ($value === 'unset') {
            return new UnsetDeclaration($name);
        }

        $method = sprintf('get%s', ucwords(str_replace(['-', '_'], '', $name)));

        if (method_exists($this, $method) === true) {
            return $this->$method($value);
        }

        return new GenericDeclaration($name, $value);
    }

    /**
     * @param mixed $value
     */
    public function getIndentStyle($value) : IndentStyle
    {
        return new IndentStyle($value);
    }
}
