<?php

namespace Tests\CommandString\Utils;

use CommandString\Utils\GeneratorUtils;
use PHPUnit\Framework\TestCase;

class GeneratorUtilsTest extends TestCase
{
    public function testBasicUuid(): void
    {
        $uuid = GeneratorUtils::uuid();

        $this->assertIsString($uuid, "Failed to generate a UUID");

        $this->assertMatchesRegularExpression("/^[a-zA-Z0-9]+$/", $uuid, "Failed to generate a UUID");

        $this->assertEquals(16, strlen($uuid), "Failed to generate a UUID");
    }

    public function testCustomCharacters(): void
    {
        $uuid = GeneratorUtils::uuid(13, ["a", "b", "c"]);

        $this->assertIsString($uuid, "Failed to generate a UUID");

        $this->assertMatchesRegularExpression("/^[abc]+$/", $uuid, "Failed to generate a UUID");

        $this->assertEquals(13, strlen($uuid), "Failed to generate a UUID");
    }

    public function testInvalidCharacterArray(): void
    {
        $this->expectException(\InvalidArgumentException::class);

        GeneratorUtils::uuid(13, ["a"]);
    }
}
