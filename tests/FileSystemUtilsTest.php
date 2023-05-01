<?php

namespace Tests\CommandString\Utils;

use CommandString\Utils\FileSystemUtils;
use PHPUnit\Framework\TestCase;

class FileSystemUtilsTest extends TestCase
{
    public const TEST_DIRECTORY = __DIR__ . DIRECTORY_SEPARATOR . "TestDirectory";

    public function testGettingAllTopFiles(): void
    {
        $testDirectoryStructure = $this->getTestFilesInTopLevel();
        $retrievedStructure = FileSystemUtils::getAllFiles(self::TEST_DIRECTORY);

        foreach ($testDirectoryStructure as $file) {
            $this->assertContains($file, $retrievedStructure, "Failed to get all top level files");
        }
    }

    public function testGettingAllFilesRecursively(): void
    {
        $testDirectoryStructure = $this->getAllTestFiles();
        $retrievedStructure = FileSystemUtils::getAllFiles(self::TEST_DIRECTORY, true);

        foreach ($testDirectoryStructure as $file) {
            $this->assertContains($file, $retrievedStructure, "Failed to get all files recursively");
        }
    }

    public function testGettingAllSubDirectories(): void
    {
        $testDirectoryStructure = $this->getSubTestDirectories();
        $retrievedStructure = FileSystemUtils::getAllSubDirectories(self::TEST_DIRECTORY);

        foreach ($testDirectoryStructure as $file) {
            $this->assertContains($file, $retrievedStructure, "Failed to get all sub directories");
        }
    }

    public function testGettingAllSubDirectoriesRecursively(): void
    {
        $testDirectoryStructure = $this->getSubTestDirectoriesRecursive();
        $retrievedStructure = FileSystemUtils::getAllSubDirectories(self::TEST_DIRECTORY, true);

        foreach ($testDirectoryStructure as $file) {
            $this->assertContains($file, $retrievedStructure, "Failed to get all sub directories recursively");
        }
    }

    public function testGettingFilesWithExtension(): void
    {
        $testDirectoryStructure = $this->getTestFilesInTopLevel();
        $extensions = ["txt"];
        $retrievedStructure = FileSystemUtils::getAllFilesWithExtensions(self::TEST_DIRECTORY, $extensions);

        foreach ($testDirectoryStructure as $file) {
            if (!str_ends_with($file, ".txt")) {
                $this->assertNotContains($file, $retrievedStructure, "Failed to get all files with extension");
                continue;
            }

            $this->assertContains($file, $retrievedStructure, "Failed to get all files with extension");
        }
    }

    public function testGettingFilesWithExtensionRecursively(): void
    {
        $testDirectoryStructure = $this->getAllTestFiles();
        $extensions = ["txt", "json"];
        $retrievedStructure = FileSystemUtils::getAllFilesWithExtensions(self::TEST_DIRECTORY, $extensions, true);

        foreach ($testDirectoryStructure as $file) {
            if (!str_ends_with($file, ".txt") && !str_ends_with($file, ".json")) {
                $this->assertNotContains(
                    $file,
                    $retrievedStructure,
                    "Failed to get all files with extension recursively"
                );
                continue;
            }

            $this->assertContains($file, $retrievedStructure, "Failed to get all files with extension recursively");
        }
    }

    public function getAllTestFiles(): array
    {
        return [
            self::TEST_DIRECTORY . DIRECTORY_SEPARATOR . "hello.md",
            self::TEST_DIRECTORY . DIRECTORY_SEPARATOR . "world.txt",
            self::TEST_DIRECTORY . DIRECTORY_SEPARATOR . "Textures" . DIRECTORY_SEPARATOR . "contacts.json",
            self::TEST_DIRECTORY . DIRECTORY_SEPARATOR . "Scripts" . DIRECTORY_SEPARATOR . "main.py",
            self::TEST_DIRECTORY . DIRECTORY_SEPARATOR . "Scripts" .
                DIRECTORY_SEPARATOR . "Tests" . DIRECTORY_SEPARATOR . "test.py"
        ];
    }

    public function getTopTestDirectories(): array
    {
        return [
            self::TEST_DIRECTORY . DIRECTORY_SEPARATOR . "Textures",
            self::TEST_DIRECTORY . DIRECTORY_SEPARATOR . "Scripts"
        ];
    }

    public function getSubTestDirectories(): array
    {
        return [
            self::TEST_DIRECTORY . DIRECTORY_SEPARATOR . "Textures",
            self::TEST_DIRECTORY . DIRECTORY_SEPARATOR . "Scripts"
        ];
    }

    public function getSubTestDirectoriesRecursive(): array
    {
        return [
            self::TEST_DIRECTORY . DIRECTORY_SEPARATOR . "Textures",
            self::TEST_DIRECTORY . DIRECTORY_SEPARATOR . "Scripts",
            self::TEST_DIRECTORY . DIRECTORY_SEPARATOR . "Scripts" . DIRECTORY_SEPARATOR . "Tests"
        ];
    }

    public function getTestFilesInTopLevel(): array
    {
        return [
            self::TEST_DIRECTORY . DIRECTORY_SEPARATOR . "hello.md",
            self::TEST_DIRECTORY . DIRECTORY_SEPARATOR . "world.txt"
        ];
    }

    public function testExceptionWhenSupplyingNonExistentDirectory(): void
    {
        $this->expectException(\LogicException::class);
        FileSystemUtils::getAllFiles("non-existent-directory");
    }
}
