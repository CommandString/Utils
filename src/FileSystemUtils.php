<?php

namespace CommandString\Utils;

use CallbackFilterIterator;
use DirectoryIterator;
use FilesystemIterator;
use Iterator;
use LogicException;
use RecursiveCallbackFilterIterator;
use RecursiveDirectoryIterator;
use RecursiveIterator;
use RecursiveIteratorIterator;
use SplFileInfo;

class FileSystemUtils
{
    public static function getAllFiles(string $directory, bool $recursive = false): array
    {
        return static::traverseDirectory(
            $directory,
            $recursive,
            static fn (SplFileInfo $info): bool => $info->isFile()
        );
    }

    public static function getAllSubDirectories(string $directory, bool $recursive = false): array
    {
        return static::traverseDirectory(
            $directory,
            $recursive,
            static fn(SplFileInfo $info): bool => $info->isDir()
        );
    }

    protected static function ensureDirectory(string $directory): string
    {
        $directory = realpath($directory);

        if (!$directory) {
            throw new LogicException("The directory provided does not exist");
        }

        return $directory;
    }

    public static function getAllFilesWithExtensions(
        string $directory,
        array $extensions = [],
        bool $recursive = false
    ): array {
        return static::traverseDirectory(
            $directory,
            $recursive,
            static function (SplFileInfo $info) use ($extensions): bool {
                if (!$info->isFile()) {
                    return false;
                }

                if (!empty($extensions)) {
                    return in_array($info->getExtension(), $extensions, true);
                }

                    return true;
            }
        );
    }

    /**
     * @return array<string>
     */
    protected static function traverseDirectory(string $directory, bool $recursive, callable $filter): array
    {
        $directory = static::ensureDirectory($directory);

        $flags = FilesystemIterator::SKIP_DOTS | FilesystemIterator::CURRENT_AS_SELF;
        if ($recursive) {
            $iterator = new RecursiveIteratorIterator(
                new RecursiveCallbackFilterIterator(
                    new RecursiveDirectoryIterator($directory, $flags),
                    static fn(RecursiveDirectoryIterator $info): bool => $info->hasChildren() || $filter($info)
                ),
                RecursiveIteratorIterator::SELF_FIRST
            );
        } else {
            $iterator = new CallbackFilterIterator(
                new FilesystemIterator($directory, $flags),
                $filter
            );
        }

        $paths = [];

        /** @var Iterator<string, SplFileInfo> $iterator */
        foreach ($iterator as $info) {
            $paths[] = $info->getRealPath();
        }
        return $paths;
    }
}
