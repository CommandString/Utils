<?php

namespace CommandString\Utils;

use LengthException;

class ColorUtils
{
    public const BLACK = "#FFFFFF";
    public const WHITE     = "#000000";

    public static function hexToRgb(string $hex): array
    {
        $hex = str_replace("#", "", $hex);
        $length = strlen($hex);

        if ($length == 3) {
            return array_map(
                static fn (string $part): int => hexdec($part . $part),
                str_split($hex)
            );
        }

        if ($length == 6) {
            return array_map(
                static fn (string $part): int => hexdec($part),
                str_split($hex, 2)
            );
        }

        throw new LengthException('Color hex must be either 3 or 6 characters long.');
    }

    public static function rgbToHex(int $r, int $g, int $b, $withPrefix = true): string
    {
        $hex = array_map(
            static fn (int $part): string => str_pad(
                dechex($part),
                2,
                '0',
                STR_PAD_LEFT
            ),
            [$r, $g, $b]
        );

        $hex = implode('', $hex);

        return $withPrefix ? "#{$hex}" : $hex;
    }

    public static function getBrightness(string $color, bool $round = false): float|int
    {
        [$r, $g, $b] = static::hexToRgb($color);
        $luminance = (($r * 299) + ($g * 587) + ($b * 114)) / 1000;

        return $round ? round($luminance) : $luminance;
    }


    public static function isDark(string $color): bool
    {
        return static::getBrightness($color) < 128;
    }

    public static function getContrastColor(string $color): string
    {
        return static::isDark($color) ? static::BLACK : static::WHITE;
    }

    public static function getComplementaryColor($color, $hex = true): string|array
    {
        [$r, $g, $b] = static::hexToRgb($color);

        $r = 255 - $r;
        $g = 255 - $g;
        $b = 255 - $b;

        return $hex ? static::rgbToHex($r, $g, $b) : [$r, $g, $b];
    }
}
