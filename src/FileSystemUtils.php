<?php

namespace CommandString\Utils;

use LogicException;

class FileSystemUtils {
    public static function getAllInDirectory(string $directory, bool $recursive = false): array
    {
        $return = [];

        $directory = realpath($directory);
    
        if (!$directory) {
            throw new LogicException("The directory provided does not exist");
        }

        foreach (scandir($directory) as $file) {
            $file_path = "$directory/$file";

            if ($file == "." || $file == "..") {
                continue;
            }

            if ($recursive) {
                if (is_dir($file_path)) {
                    $return[$file_path] = self::getAllInDirectory($file_path, true);
                } else {
                    $return[] = $file_path;
                }
            } else {
                $return[] = $file_path;
            }
        }

        return $return;
    }
}