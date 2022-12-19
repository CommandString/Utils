<?php

namespace CommandString\Utils;

use stdClass;

class ArrayUtils {
    public static function toStdClass(array $array): stdClass
    {
        $toStdClass = function (array $array, callable $toStdClass) {
            $stdClass = new stdClass();

            $toStdClass = function (\Closure $toStdClass, array $array, array $levels = []) use ($stdClass) {
                foreach ($array as $key => $value) {
                    if (is_array($value)) {
                        $newLevels = array_merge($levels, [$key]);
                        $toStdClass($toStdClass, $value, $newLevels);
                        continue;
                    }

                    $level = &$stdClass;
                    foreach ($levels as $levelName) {
                        if (!isset($level->$levelName)) {
                            $level->$levelName = new stdClass;
                        }

                        $level = &$level->$levelName;
                    }
                    $level->$key = $value;
                }
            };

            $toStdClass($toStdClass, $array);

            return $stdClass;
        };

        return $toStdClass($array, $toStdClass);
    }
    
    public static function trimValues(array $array, string $characters = " \n\r\t\v\x00"): array
    {
        foreach ($array as $key => $value) {
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
        return $array[array_keys($array)[count($array)-1]];
    }
}
