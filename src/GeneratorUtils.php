<?php

namespace CommandString\Utils;
use InvalidArgumentException;

class GeneratorUtils {
    public static function uuid(int $length = 16, ?array $characters = null): string
    {
        $characters = $characters ?? array_merge(range("A", "Z"), range("a", "z"), range(0, 9));
        $id = "";

        if (count($characters) < 2) {
            throw new InvalidArgumentException("The character array must have two items!");
        }

        for ($i = 0; $i < $length; $i++) {
            $id .= $characters[rand(0, count($characters)-1)];
        }

        return $id;
    }
}
