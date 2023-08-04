<?php

namespace CommandString\Utils;

use LogicException;

class StringUtils
{
    public static function getBetween(
        string $start,
        string $end,
        string $string,
        bool $include_start_end_with_response = false
    ): string {
        $startPos = stripos($string, $start);
        $endPos = strripos($string, $end);

        if ($startPos === false || $endPos === false) {
            throw new LogicException("Unable to find the start and/or the end position!");
        }

        if (!$include_start_end_with_response) {
            $startPos += strlen($start);
            $endPos -= strlen($end);
        }

        return substr($string, $startPos, ($endPos - $startPos) + 1);
    }

    public static function getAllOccurrences(string $haystack, string $needle, bool $caseSensitive = true): array
    {
        $offset = 0;
        $poses = [];

        $strPos = fn($haystack, $needle, $offset) => $caseSensitive ? strpos($haystack, $needle, $offset) : stripos($haystack, $needle, $offset);

        while (true) {
            $pos = $strPos($haystack, $needle, $offset);

            if ($pos === false) {
                break;
            }

            $poses[] = $pos;
            $offset = $pos + strlen($needle);
        }

        return $poses;
    }
}
