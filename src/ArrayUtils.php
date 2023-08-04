<?php

namespace CommandString\Utils;

use stdClass;
use Stringable;

class ArrayUtils
{
    public static function toStdClass(array $array): stdClass
    {
        $object = (object) $array;
        foreach ($object as &$value) {
            if (is_array($value)) {
                $value = static::toStdClass($value);
            }
        }
        unset($value);

        return $object;
    }

    public static function randomize(array $array, bool $preserveKeys = false): array
    {
        if (!$preserveKeys) {
            shuffle($array);

            return $array;
        }


        $keys = array_keys($array);
        shuffle($keys);

        return array_reduce(
                $keys,
                static function (array $accumulator, string|int $key) use ($array): array {
                    $accumulator[$key] = $array[$key];

                    return $accumulator;
                },
                []
        );
    }

    public static function trimValues(array $array, string $characters = " \n\r\t\v\x00"): array
    {
        foreach ($array as &$value) {
            if (is_array($value)) {
                $value = self::trimValues($value);
            } elseif (is_scalar($value) || $value instanceof Stringable || method_exists($value, '__toString')) {
                $value = trim($value, $characters);
            }
        }
        unset($value);

        return $array;
    }

    public static function getLastItem(array $array): mixed
    {
        return array_pop($array);
    }
}
