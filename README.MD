# Hex2RGBA

It's a small PHP pack to convert hexadecimal color to rgba!

### Installation

Run the command in your project folder:

```
composer require frnxstd/hex2rgba
```

### Example usage

```php
<?php
require_once __DIR__ . '/../vendor/autoload.php'; // Autoload files using Composer autoload

use hex2rgba\hex2rgba;

/** @var hex2rgba $hex2rgba */
$hex2rgba = new hex2rgba();

$cases = array(
    array('#FFF',    '0.3'),
    array('#FFFFFF', 1),
    array('FFF',     '.5'),
    array('FFFFFF',  1),
    array('FFFFF',   1)
);

foreach ($cases as $case)
{
    try{
        echo $hex2rgba->convert($case[0], $case[1]);

        echo '<hr>';

    } catch (Exception $exception)
    {
        die($exception->getMessage());
    }
}
```