<?php

namespace Tests\CommandString\Utils;

use CommandString\Utils\StringUtils;
use PHPUnit\Framework\TestCase;

class StringUtilsTest extends TestCase
{
    public function testGettingInBetweenString()
    {
        $json = 'asdasad{"name": "John Doe", "age": 30, "car": null}dasdsdadasd';
        $inBetween = StringUtils::getBetween("{", "}", $json);

        $this->assertEquals('"name": "John Doe", "age": 30, "car": null', $inBetween);

        $inBetween = StringUtils::getBetween("{", "}", $json, true);

        $this->assertEquals('{"name": "John Doe", "age": 30, "car": null}', $inBetween);
    }

    public function testExceptionWhenSupplyInvalidStartAndEndPoint()
    {
        $string = 'asdasad{"name": "John Doe", "age": 30, "car": null}dasdsdadasd';

        $this->expectException(\LogicException::class);

        StringUtils::getBetween("(", ")", $string);
    }

    public function testGettingAllOccurrences()
    {
        $string = 'abbabbbababaAb';

        $this->assertEquals([0, 3, 7, 9, 11], StringUtils::getAllOccurrences($string, 'a'));
        $this->assertEquals([0, 3, 7, 9, 11, 12], StringUtils::getAllOccurrences($string, 'a', false));
    }
}
