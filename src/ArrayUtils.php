<?php

namespace CommandString\Utils;

use stdClass;

class ArrayUtils
{
    public static function toStdClass(array $array): stdClass
    {
        $toStdClass = function (array $array, callable $toStdClass) {
            $stdClass = new stdClass();

            foreach ($array as $key => $value) {
                if (is_array($value)) {
                    $value = $toStdClass($value, $toStdClass);
                }

                $stdClass->$key = $value;
            }

            return $stdClass;
        };

        return $toStdClass($array, $toStdClass);
    }

    public static function randomize(array $array): array
    {
        $keys = array_keys($array);
        $randomized_keys = [];
        for ($i = 0; $i < count($keys); $i++) {
            $random_key = $keys[mt_rand(0, count($keys) - 1)];

            if (in_array($random_key, $randomized_keys)) {
                $i--;
                continue;
            }

            $randomized_keys[] = $random_key;
        }

        $randomized_array = [];
        foreach ($randomized_keys as $key) {
            $randomized_array[] = $array[$key];
        }

        return $randomized_array;
    }

    public static function trimValues(array $array, string $characters = " \n\r\t\v\x00"): array
    {
        foreach ($array as &$value) {
            if (is_array($value)) {
                $value = self::trimValues($array);
            } else {
                $value = trim($value, $characters);
            }
        }

        return $array;
    }

    public static function getLastItem(array $array): mixed
    {
        return $array[array_keys($array)[count($array) - 1]];
    }
}
