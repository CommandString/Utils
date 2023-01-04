<?php

namespace CommandString\Utils;

class ColorUtils {
    public static function RGBAtoHEX(int $red, int $blue, int $green, ?int $alpha = null) {
        $hex = [dechex($red), dechex($blue), dechex($green)];

        if (!is_null($alpha)) {
            $hex[] = dechex($alpha);
        }

        foreach ($hex as $key => $value) {
            if (strlen($value) !== 2) {
                $hex[$key] = "0$value";
            }
        }

        $hex = implode($hex);

        return $hex;
    }

    public static function HEXtoRGBA(string $hex): array
    {
        $rgba = str_split(str_replace("#", "", $hex), 2);

        foreach ($rgba as $key => $value) {
            $rgba[$key] = hexdec($value);
        }

        return $rgba;
    }
}