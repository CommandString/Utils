

# CommandString/Utils #
Basic utility functions for PHP

# ArrayUtils #

## toStdClass(array $array): stdClass ##

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

### randomize(array $array): array

randomizes the given array

```php
$characters = str_split("Command_String");
$randomized_characters = ArrayUtils::randomize($characters);

foreach ($randomized_characters as $character) {
    echo $character;
}
```

# StringUtils

## getBetween(string $start, string $end, string $string, bool $include_start_end_with_response = false): string

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

## uuid(int $length = 16, array $characters = []): string

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