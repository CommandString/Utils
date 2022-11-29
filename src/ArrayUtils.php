<?php

namespace CommandString\Utils;

use stdClass;

class ArrayUtils {
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

    public static function getLastItem(array $array): mixed
    {
        return $array[array_keys($array)[count($array)-1]];
    }
}