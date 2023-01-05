<?php

namespace CommandString\Utils;

use stdClass;

enum FileSizeUtils: string
{
    case BYTE = "Byte";
    case KILOBYTE = "Kilobyte";
    case MEGABYTE = "Megabyte";
    case GIGABYTE = "Gigabyte";
    case TERABYTE = "Terabyte";
    case PETABYTE = "Petabyte";
    case EXABYTE = "Exabyte";
    case ZETTABYTE = "Zettabyte";
    case YOTTABYTE = "Yottabyte";

    private static function byteTo(self $to, float $from): float
    {
        switch ($to) {
            case self::BYTE:
                return $from;
            case self::KILOBYTE:
                return $from / 1000;
            case self::MEGABYTE:
                return $from / 1e+6;
            case self::GIGABYTE:
                return $from / 1e+9;
            case self::TERABYTE:
                return $from / 1e+12;
            case self::PETABYTE:
                return $from / 1e+15;
            case self::EXABYTE:
                return $from / 1e+18;
            case self::ZETTABYTE:
                return $from / 1e+21;
            case self::YOTTABYTE:
                return $from / 1e+24;
        }
    }
    
    private static function toBytes(self $from_type, float $from_size): float
    {
        switch ($from_type) {
            case self::BYTE:
                return $from_size;
            case self::KILOBYTE:
                return $from_size * 1000;
            case self::MEGABYTE:
                return $from_size * 1e+6;
            case self::GIGABYTE:
                return $from_size * 1e+9;
            case self::TERABYTE:
                return $from_size * 1e+12;
            case self::PETABYTE:
                return $from_size * 1e+15;
            case self::EXABYTE:
                return $from_size * 1e+18;
            case self::ZETTABYTE:
                return $from_size * 1e+21;
            case self::YOTTABYTE:
                return $from_size * 1e+24;
        }
    }

    public static function convertFileSize(self $from_type, self $to_type, float $from_size): float
    {
        return self::byteTo($to_type, self::toBytes($from_type, $from_size));
    }

    public static function humanReadable(self $type, float $size, int $decimals = 0): string
    {
        $reduced = self::reduceFileSize($type, $size);

        return number_format($reduced->size, $decimals)." ".self::getTypeAbbreviation($reduced->type);
    }

    public static function reduceFileSize(self $type, float $size): stdClass
    {
        $result = new stdClass;

        $bytes = self::convertFileSize($type, self::BYTE, $size);
        $factor = floor((strlen($bytes) - 1) / 3);

        $result->type = self::cases()[$factor];
        $result->size = $bytes / (1000 ** $factor);

        return $result;
    }

    public static function getTypeAbbreviation(self $type): string
    {
        switch ($type) {
            case self::BYTE:
                return "B";
            case self::KILOBYTE:
                return "KB";
            case self::MEGABYTE:
                return "MB";
            case self::GIGABYTE:
                return "GB";
            case self::TERABYTE:
                return "TB";
            case self::PETABYTE:
                return "PB";
            case self::EXABYTE:
                return "EB";
            case self::ZETTABYTE:
                return "ZB";
            case self::YOTTABYTE:
                return "YB";
        }
    }
}