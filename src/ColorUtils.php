<?php

namespace CommandString\Utils;

class ColorUtils
{
    public static function hexToRgb(string $hex): array
    {
        $hex = str_replace("#", "", $hex);
        if (strlen($hex) == 3) {
            $r = hexdec(substr($hex, 0, 1) . substr($hex, 0, 1));
            $g = hexdec(substr($hex, 1, 1) . substr($hex, 1, 1));
            $b = hexdec(substr($hex, 2, 1) . substr($hex, 2, 1));
        } else {
            $r = hexdec(substr($hex, 0, 2));
            $g = hexdec(substr($hex, 2, 2));
            $b = hexdec(substr($hex, 4, 2));
        }
        return [$r, $g, $b];
    }

    public static function rgbToHex(int $r, int $g, int $b, $withPrefix = true): string
    {
        $r = dechex($r);
        $g = dechex($g);
        $b = dechex($b);

        $r = strlen($r) == 1 ? "0" . $r : $r;
        $g = strlen($g) == 1 ? "0" . $g : $g;
        $b = strlen($b) == 1 ? "0" . $b : $b;

        $hex = $r . $g . $b;

        return $withPrefix ? "#{$hex}" : $hex;
    }

    public static function getBrightness(string $color, bool $round = false): float|int
    {
        $rgb = self::hexToRgb($color);
        $luminance = (($rgb[0] * 299) + ($rgb[1] * 587) + ($rgb[2] * 114)) / 1000;
        return $round ? round($luminance) : $luminance;
    }


    public static function isDark(string $color): bool
    {
        $brightness = self::getBrightness($color);
        return ($brightness < 128);
    }

    public static function getContrastColor(string $color): string
    {
        return self::isDark($color) ? "#FFFFFF" : "#000000";
    }

    public static function getComplementaryColor($color, $hex = true): string|array
    {
        $rgb = self::hexToRgb($color);
        $r = 255 - $rgb[0];
        $g = 255 - $rgb[1];
        $b = 255 - $rgb[2];
        return $hex ? self::rgbToHex($r, $g, $b) : [$r, $g, $b];
    }
}
