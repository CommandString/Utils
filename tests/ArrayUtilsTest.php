<?php

namespace CommandString\Utils\Tests;

use CommandString\Utils\ArrayUtils;
use PHPUnit\Framework\TestCase;
use stdClass;

final class ArrayUtilsTest extends TestCase
{
    public function testArrayConvertsToStdClass(): void
    {
        $array = [
            'name' => 'John Doe',
            'age' => 32,
            'address' => [
                'street' => '51 Middle st.',
                'city' => 'Nowhere',
                'country' => 'Neverland',
            ],
        ];

        $stdClass = new stdClass;

        $stdClass->name = 'John Doe';
        $stdClass->age = 32;
        $stdClass->address = new stdClass;
        $stdClass->address->street = '51 Middle st.';
        $stdClass->address->city = 'Nowhere';
        $stdClass->address->country = 'Neverland';

        $convertedArray = ArrayUtils::toStdClass($array);

        // loop over all items of the stdClass and make sure the types and values match the stdClass
        foreach ($stdClass as $key => $value) {
            if (is_array($convertedArray->$key)) {
                $this->fail("Converted array contains an array instead of stdClass");
            }

            $this->assertEquals($stdClass->$key, $convertedArray->$key);
        }
    }

    public function testArrayTrimsValues(): void
    {
        $array = [
            'name' => '   John Doe   ',
            'age' => 32,
            'street' => ' 51 Middle st.    ',
            'city' => '  Nowhere   ',
            'country' => '     Neverland '
        ];

        $manuallyTrimmedArray = [
            'name' => 'John Doe',
            'age' => 32,
            'street' => '51 Middle st.',
            'city' => 'Nowhere',
            'country' => 'Neverland'
        ];

        $trimmedArray = ArrayUtils::trimValues($array);

        foreach (array_keys($manuallyTrimmedArray) as $key) {
            $this->assertEquals($manuallyTrimmedArray[$key], $trimmedArray[$key]);
        }
    }

    public function testArrayTrimsValuesWithCustomCharacters(): void
    {
        $array = [
            'name' => ':John Doe;',
            'age' => 32,
            'street' => ':51 Middle st.;',
            'city' => ':Nowhere;',
            'country' => ':Neverland;'
        ];

        $manuallyTrimmedArray = [
            'name' => 'John Doe',
            'age' => 32,
            'street' => '51 Middle st.',
            'city' => 'Nowhere',
            'country' => 'Neverland'
        ];

        $trimmedArray = ArrayUtils::trimValues($array, ':;');

        foreach (array_keys($manuallyTrimmedArray) as $key) {
            $this->assertEquals($manuallyTrimmedArray[$key], $trimmedArray[$key]);
        }
    }

    public function testArrayGettingLastItemOfAssociativeArray(): void
    {
        $array = [
            'name' => 'John Doe',
            'age' => 32,
            'street' => '51 Middle st.',
            'city' => 'Nowhere',
            'country' => 'Neverland'
        ];

        $lastItem = ArrayUtils::getLastItem($array);

        $this->assertEquals($array['country'], $lastItem);
    }

    public function testArrayGettingLastItemOfArray(): void
    {
        $array = [
            'John Doe',
            32,
            '51 Middle st.',
            'Nowhere',
            'Neverland'
        ];

        $lastItem = ArrayUtils::getLastItem($array);

        $this->assertEquals($array[4], $lastItem);
    }

    public function testArrayGettingRandomized(): void
    {
        $array = [
            'John Doe',
            32,
            '51 Middle st.',
            'Nowhere',
            'Neverland'
        ];

        $randomizedArray = ArrayUtils::randomize($array);

        $this->assertNotEquals($array, $randomizedArray);
    }
}