<?php

namespace Tests\CommandString\Utils;

use CommandString\Utils\ColorUtils;
use PHPUnit\Framework\TestCase;

class ColorUtilsTest extends TestCase {
    public function testHexConvertsToRgb(): void
    {
        $hex = "#FFFFFF";
        $rgb = ColorUtils::hexToRgb($hex);
        $this->assertEquals([255, 255, 255], $rgb, "Hex to RGB conversion failed");

        $hex = "#FFF";
        $rgb = ColorUtils::hexToRgb($hex);
        $this->assertEquals([255, 255, 255], $rgb, "Hex to RGB conversion failed for short hex");
    }

    public function testRgbConvertsToHex(): void
    {
        $rgb = [255, 255, 255];
        $hex = ColorUtils::rgbToHex(...$rgb);
        $this->assertEquals("#ffffff", $hex, "RGB to Hex conversion failed");

        $rgb = [255, 255, 255];
        $hex = ColorUtils::rgbToHex(...[...$rgb, false]);
        $this->assertEquals("ffffff", $hex, "RGB to Hex conversion failed without prefix");
    }

    public function testIsDark(): void
    {
        $color = "#ffffff";
        $isDark = ColorUtils::isDark($color);
        $this->assertFalse($isDark, "Color is not dark");

        $color = "#000000";
        $isDark = ColorUtils::isDark($color);
        $this->assertTrue($isDark, "Color is dark");
    }

    public function getContrastColor(): void
    {
        $color = "#8800FF";
        $contrastColor = ColorUtils::getContrastColor($color);
        $this->assertEquals("#000000", $contrastColor, "Contrast color is not black");

        $color = "#0088FF";
        $contrastColor = ColorUtils::getContrastColor($color);
        $this->assertEquals("#ffffff", $contrastColor, "Contrast color is not white");
    }

    public function getComplimentaryColor(): void
    {
        $color = "#8800FF";
        $complimentaryColor = ColorUtils::getComplementaryColor($color);
        $this->assertEquals("#77ff00", $complimentaryColor, "Complimentary color is not green");

        $color = "#0088FF";
        $complimentaryColor = ColorUtils::getComplementaryColor($color);
        $this->assertEquals("#ff7700", $complimentaryColor, "Complimentary color is not orange");
    }
}
