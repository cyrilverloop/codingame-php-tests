<?php

declare(strict_types=1);

namespace CyrilVerloop\Codingame\Tests\Training\Easy\Temperatures;

use CyrilVerloop\Codingame\Tests\PuzzleTest;
use CyrilVerloop\Codingame\Training\Easy\Temperatures\Temperatures;

/**
 * @coversDefaultClass \CyrilVerloop\Codingame\Training\Easy\Temperatures\Temperatures
 * @group temperatures
 */
final class TemperaturesTest extends PuzzleTest
{
    // Methods :

    /**
     * Initialises tests.
     */
    public function setUp(): void
    {
        $this->puzzle = new Temperatures();
    }

    /**
     * Test that the code can be executed for "Simple test case".
     *
     * @covers ::execute
     * @group unary_simpleTestCase
     */
    public function testCanExecuteSimpleTestCase(): void
    {
        $this->expectExecuteOutputAnswer(
            __DIR__ . '/input/01 - simple test case.txt',
            '1' . PHP_EOL
        );
    }

    /**
     * Test that the code can be executed for "Only negative numbers".
     *
     * @covers ::execute
     * @group unary_onlyNegativeNumbers
     */
    public function testCanExecuteOnlyNegativeNumbers(): void
    {
        $this->expectExecuteOutputAnswer(
            __DIR__ . '/input/02 - only negative numbers.txt',
            -5 . PHP_EOL
        );
    }

    /**
     * Test that the code can be executed for "Choose the right temperature".
     *
     * @covers ::execute
     * @group unary_chooseTheRightTemperature
     */
    public function testCanExecuteChooseTheRightTemperature(): void
    {
        $this->expectExecuteOutputAnswer(
            __DIR__ . '/input/03 - choose the right temperature.txt',
            5 . PHP_EOL
        );
    }

    /**
     * Test that the code can be executed for "Choose the right temperature 2".
     *
     * @covers ::execute
     * @group unary_chooseTheRightTemperature2
     */
    public function testCanExecuteChooseTheRightTemperature2(): void
    {
        $this->expectExecuteOutputAnswer(
            __DIR__ . '/input/04 - choose the right temperature 2.txt',
            5 . PHP_EOL
        );
    }

    /**
     * Test that the code can be executed for "Complex test case".
     *
     * @covers ::execute
     * @group unary_complexTestCase
     */
    public function testCanExecuteComplexTestCase(): void
    {
        $this->expectExecuteOutputAnswer(
            __DIR__ . '/input/05 - complex test case.txt',
            2 . PHP_EOL
        );
    }

    /**
     * Test that the code can be executed for "No temperature".
     *
     * @covers ::execute
     * @group unary_noTemperature
     */
    public function testCanExecuteNoTemperature(): void
    {
        $this->expectExecuteOutputAnswer(
            __DIR__ . '/input/06 - no temperature.txt',
            0 . PHP_EOL
        );
    }
}
