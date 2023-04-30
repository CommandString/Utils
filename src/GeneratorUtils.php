<?php

namespace CommandString\Utils;
use InvalidArgumentException;

class GeneratorUtils {
    public static function uuid(int $length = 16): string
    {
        $salt = random_bytes($length);
        $time = microtime(true);
        $hash = hash('sha256', $salt . $time);
        return $hash;
    }

    public static function randomString(int $length = 16, ?array $characters = null): string
    {
        if (is_null($characters)) 
            $characters = array_merge(range('a', 'z'), range('A', 'Z'));

        $charactersLength = count($characters) - 1;
        $string = '';

        for ($i = 0; $i < $length; $i++) 
            $string .= $characters[random_int(0, $charactersLength)];

        return $string;
    }
}
