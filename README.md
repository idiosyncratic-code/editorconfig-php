# EditorConfig PHP
PHP implementation of [EditorConfig](https://editorconfig.org)

## Usage

```php
<?php

require_once('vendor/autoload.php');

use Idiosyncratic\EditorConfig\EditorConfig;

$ec = new EditorConfig();

// Print matching configuration rules as string
print $ec->printConfigForPath(__FILE__) . PHP_EOL;
```
