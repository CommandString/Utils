

# CommandString/Utils #
Basic utility functions for PHP

# ArrayUtils #

```php
toStdClass(array $array): stdClass
```

Converts array to an stdClass

```php
$users = [
    "value" => [
        "users" => [
            [
                "username" => "user",
                "password" => "********",
                "email" => "user@example.com"
            ]
        ]
    ],
    "token" => "********************************"
];

$users = ArrayUtils::toStdClass($users);

var_dump($users);
/* output
object(stdClass)#2 (2) {
    ["value"]=>
    object(stdClass)#4 (1) {
        ["users"]=>
        object(stdClass)#5 (1) {
        ["0"]=>
        object(stdClass)#6 (3) {
            ["username"]=>
            string(4) "user"
            ["password"]=>
            string(8) "********"
            ["email"]=>
            string(16) "user@example.com"
        }
        }
    }
    ["token"]=>
    string(32) "********************************"
}
*/
```
---
```php
randomize(array $array): array
```

randomizes the given array

```php
$characters = str_split("Command_String");
$randomized_characters = ArrayUtils::randomize($characters);

foreach ($randomized_characters as $character) {
    echo $character;
}
```

# StringUtils

```php
getBetween(string $start, string $end, string $string, bool $include_start_end_with_response = false): string
```

Gets text between to specified points in a string and returns it.

```php
$greeting = "My name is Bob! What's yours?";

$name = StringUtils::getBetween("is ", "!", $greeting);

echo $name; // output: Bob
```

***If*** you want the start and end to be returned you can set the fourth argument to true, a good use case for this would be parsing a json string out of a blob of text

```php
$text = 'fdsjhyasdfuygfdsuygfduygfsd{"name": "Bob"}asduygasduyauysduytasduy?';

$json = StringUtils::getBetween("{", "}", $text, true);

echo $json; // output: {"name": "Bob"}

var_dump(json_decode($json)); 
/* output: 
object(stdClass)#3 (1) {
  ["name"]=>
  string(5) "Bob"
}
*/
```

# GeneratorUtils

```php
uuid(int $length = 16, array $characters = []): string
```

Generates a UUID.

Generically the method will return a 16 character alphanumeric string 

```php
echo GeneratorUtils::uuid(); // output: 6MwqCff0wdpUl1sdw
```

You can adjust the length as needed

```php
echo GeneratorUtils::uuid(5); // output: 8zWgWw
```

You can also supply characters for the generator to use

```php
echo GeneratorUtils::uuid(10, [1, 0]); // output: 11110100100
```

# FileSystemUtils 

```php
getAllFiles(string $directory, bool $recursive = false): array
```

Get all files in a directory, if the second parameter is true then files in subdirectories will be included in the returned array

---

```php
getAllSubDirectories(string $directory, bool $recursive = false): array
```

Get all subdirectories in a directory and if recursive is true all subdirectories of the subdirectories will be included

---

```php
getAllFilesWithExtensions(string $directory, array $extensionsToFind, bool $recursive = false): array
```

Get all files in a directory with one of the supplied extensions. If the third parameter is true then the directories' subdirectories will be searched as well.

---

# ColorUtils

```php
RGBAtoHEX(int $red, int $blue, int $green, ?int $alpha = null): string
```

Converts a RGBA color code to a HEX color code

---

```php
HEXtoRGBA(string $hex): array
```

Converts a HEX color code to a RGBA color code.

---

# FileSizeUtils

```php
convertFileSize(FileSizeUtils $from_type, FileSizeUtils $to_type, float $from_size): float
```

Convert a file size from one type to another

---

```php
humanReadable(FileSizeUtils $type, float $size, int $decimals = 0): string
```

Creates reduces the format that appends to type abbreviation to the end.

```php
echo FileSizeUtils::humanReadable(FileSizeUtils::MEGABYTE, 5000); // output: 5 GB
```

---

```php
reduceFileSize(FileSizeUtils $type, float $size): stdClass
```

Reduces a file size to the smallest it can be before being smaller than 1. An stdClass with a type property is then returned alongside a size property for the new size.

```php
var_dump(FileSizeUtils::humanReadable(FileSizeUtils::MEGABYTE, 5000));
/**
 *  object(stdClass)#12 (2) {
 *  ["type"]=>
 *      enum(CommandString\Utils\FileSizeUtils::GIGABYTE)
 *  ["size"]=>
 *      float(5)
 *  }
 */
```

