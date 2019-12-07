<?php

declare(strict_types=1);

namespace Idiosyncratic\EditorConfig\Declaration;

final class TrimTrailingWhitespace extends BooleanDeclaration
{
    public function getName() : string
    {
        return 'trim_trailing_whitespace';
    }
}
