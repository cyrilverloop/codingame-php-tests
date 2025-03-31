<?php

declare(strict_types=1);

namespace CyrilVerloop\Codingame\Tests\Easy\APuzzle;

use CyrilVerloop\Codingame\Easy\APuzzle\CGCode;
use CyrilVerloop\Codingame\Tests\CGTestCase;
use PHPUnit\Framework\Attributes as PA;

/**
 * Tests for "A name".
 */
#[
    PA\CoversClass(CGCode::class),
    PA\Group('anAlphanumName'),
    PA\TestDox('A name'),
    PA\Medium
]
final class CGTest extends CGTestCase
{
    public function setUp(): void
    {
        $this->cgCode = new CGCode();
    }

    /**
     * Tests the code with "Test name".
     */
    #[
        PA\Group('anAlphanumName_testGroup'),
        PA\TestDox('Test name')
    ]
    public function testTestMethod(): void
    {
        $this->expectExecuteOutputAnswer(
            __DIR__ . '/input/01 - test file.txt',
            file_get_contents(__DIR__ . '/output/01 - test file.txt')
        );
    }

    /**
     * Tests the code with "Test name with * /".
     */
    #[
        PA\Group('anAlphanumName_testGroup2'),
        PA\TestDox('Test name with */')
    ]
    public function testTestMethod2(): void
    {
        $this->expectExecuteOutputAnswer(
            __DIR__ . '/input/02 - test file 2.txt',
            file_get_contents(__DIR__ . '/output/02 - test file 2.txt')
        );
    }
}
