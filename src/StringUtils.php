<?php

namespace CommandString\Utils;
use LogicException;
class StringUtils {
    /**
     * Get characters between two certain points in a string
     *
     * @param string $start
     * @param string $end
     * @param string $string
     * @param boolean $include_start_end_with_response will return $start and $end with the string if set to true
     * @return string
     */
    public static function getBetween(string $start, string $end, string $string, bool $include_start_end_with_response = false): string
    {
        $startPos = stripos($string, $start);
        $endPos = strripos($string, $end);

        if (!$include_start_end_with_response) {
            $startPos += strlen($start);
            $endPos -= strlen($end);
        }
        
        if ($startPos === false || $endPos === false) {
            throw new LogicException("Unable to find the start and/or the end position!");
        }

        return substr($string, $startPos, ($endPos-$startPos)+1);
    }
}