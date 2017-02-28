# id-date-formatter
PHP Date Formatter for Bahasa Indonesia. The main usable methods were ```format()``` to format the date and ```now()``` to get the current date. All methods were defined static. So, yo don't need to create the object from ```IdDateFormatter``` class.

## Usage
Example codes:
```php
use FrosyaLabs\Lang\IdDateFormatter;

$tanggal = '2016-02-17';

// Show current date, format: dd/mm/yyyy
echo IdDateFormatter::now().'<br>';

// Format $tanggal using complete format, ex:
// Rabu, 17 Februari 2016
echo IdDateFormatter::format($tanggal, IdDateFormatter::COMPLETE);
```

\* For more information, please check the library's PHPDoc
