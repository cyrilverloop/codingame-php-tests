<?php

declare(strict_types=1);

namespace CyrilVerloop\Codingame\Tests\Generator;

use CyrilVerloop\Codingame\Generator\CGTestGenerator;
use CyrilVerloop\Codingame\Generator\FileGenerator;
use CyrilVerloop\Codingame\Generator\TestConfiguration;
use CyrilVerloop\Codingame\Generator\TestConfigurations;
use CyrilVerloop\Codingame\Generator\TestGeneratorConfiguration;
use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\Attributes as PA;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the test generator.
 */
#[
    PA\CoversClass(CGTestGenerator::class),
    PA\UsesClass(FileGenerator::class),
    PA\UsesClass(TestGeneratorConfiguration::class),
    PA\UsesClass(TestConfiguration::class),
    PA\UsesClass(TestConfigurations::class),
    PA\Group('cgpt'),
    PA\Group('cgpt_generator'),
    PA\Group('cgpt_generator_CGTestGenerator')
]
final class CGTestGeneratorTest extends TestCase
{
    // Methods :

    /**
     * Returns the file system.
     * @return mixed[] the file system.
     */
    public function getFileSystem(): array
    {
        return [
            'config' => [
                'easy' => [
                    'APuzzle' => [
                        'input' => [
                            '01 - test file.txt' => file_get_contents(__DIR__ . '/Example/input/01 - test file.txt'),
                            '02 - test file 2.txt' => file_get_contents(__DIR__ . '/Example/input/02 - test file 2.txt')
                        ],
                        'output' => [
                            '01 - test file.txt' => file_get_contents(__DIR__ . '/Example/output/01 - test file.txt'),
                            '02 - test file 2.txt' => file_get_contents(__DIR__ . '/Example/output/02 - test file 2.txt')
                        ]
                    ]
                ]
            ]
        ];
    }

    /**
     * Tests that the test is generated.
     */
    public function testGenerateTheTestFile(): void
    {
        $TestConfiguration = new TestConfiguration(
            'Test name',
            'testGroup',
            'TestMethod',
            '01 - test file.txt'
        );
        $TestConfiguration2 = new TestConfiguration(
            'Test name with */',
            'testGroup2',
            'TestMethod2',
            '02 - test file 2.txt'
        );

        $testConfigurations = new TestConfigurations();
        $testConfigurations->add($TestConfiguration);
        $testConfigurations->add($TestConfiguration2);

        $configuration = new TestGeneratorConfiguration(
            'Easy\APuzzle',
            'A name',
            'anAlphanumName',
            $testConfigurations
        );

        $fileSystem = vfsStream::setup(structure: $this->getFileSystem());

        $testGenerator = new CGTestGenerator(__DIR__ . '/../../templates/');
        $testGenerator->generate(
            $configuration,
            $fileSystem->url() . '/config/easy/APuzzle/',
            $fileSystem->url() . '/tests/Easy/APuzzle/'
        );

        self::assertFileExists($fileSystem->url() . '/tests/Easy/APuzzle/CGTest.php');
        self::assertFileEquals(
            __DIR__ . '/Example/CGTest.php',
            $fileSystem->url() . '/tests/Easy/APuzzle/CGTest.php',
        );
    }

    /**
     * Tests that the input files are copied.
     */
    public function testCopyTheInputFiles(): void
    {
        $configuration = new TestGeneratorConfiguration(
            'Easy\APuzzle',
            'A name',
            'anAlphanumName',
            new TestConfigurations()
        );

        $fileSystem = vfsStream::setup(structure: $this->getFileSystem());

        $testGenerator = new CGTestGenerator(__DIR__ . '/../../templates/');
        $testGenerator->generate(
            $configuration,
            $fileSystem->url() . '/config/easy/APuzzle/',
            $fileSystem->url() . '/tests/Easy/APuzzle/'
        );

        self::assertFileExists($fileSystem->url() . '/tests/Easy/APuzzle/input/01 - test file.txt');
        self::assertFileEquals(
            __DIR__ . '/Example/input/01 - test file.txt',
            $fileSystem->url() . '/tests/Easy/APuzzle/input/01 - test file.txt'
        );

        self::assertFileExists($fileSystem->url() . '/tests/Easy/APuzzle/input/02 - test file 2.txt');
        self::assertFileEquals(
            __DIR__ . '/Example/input/02 - test file 2.txt',
            $fileSystem->url() . '/tests/Easy/APuzzle/input/02 - test file 2.txt'
        );
    }

    /**
     * Tests that the output files are copied.
     */
    public function testCopyTheOutputFiles(): void
    {
        $configuration = new TestGeneratorConfiguration(
            'Easy\APuzzle',
            'A name',
            'anAlphanumName',
            new TestConfigurations()
        );

        $fileSystem = vfsStream::setup(structure: $this->getFileSystem());

        $testGenerator = new CGTestGenerator(__DIR__ . '/../../templates/');
        $testGenerator->generate(
            $configuration,
            $fileSystem->url() . '/config/easy/APuzzle/',
            $fileSystem->url() . '/tests/Easy/APuzzle/'
        );

        self::assertFileExists($fileSystem->url() . '/tests/Easy/APuzzle/output/01 - test file.txt');
        self::assertFileEquals(
            __DIR__ . '/Example/output/01 - test file.txt',
            $fileSystem->url() . '/tests/Easy/APuzzle/output/01 - test file.txt'
        );

        self::assertFileExists($fileSystem->url() . '/tests/Easy/APuzzle/output/02 - test file 2.txt');
        self::assertFileEquals(
            __DIR__ . '/Example/output/02 - test file 2.txt',
            $fileSystem->url() . '/tests/Easy/APuzzle/output/02 - test file 2.txt'
        );
    }


    /**
     * Tests that the test is not generated
     * if it already exist.
     */
    public function testDoNotGenerateTheCodeFileIfItAlreadyExist(): void
    {
        $testConfigurations = new TestConfigurations();

        $configuration = new TestGeneratorConfiguration(
            'Easy\APuzzle',
            'A name',
            'anAlphanumName',
            $testConfigurations
        );

        $fileStructure = $this->getFileSystem();
        $fileStructure['tests'] = [
            'Easy' => [
                'APuzzle' => [
                    'CGTest.php' => 'modified-test'
                ]
            ]
        ];
        $fileSystem = vfsStream::setup(structure: $fileStructure);

        $testGenerator = new CGTestGenerator(__DIR__ . '/../../templates/');
        $testGenerator->generate(
            $configuration,
            $fileSystem->url() . '/config/easy/APuzzle/',
            $fileSystem->url() . '/tests/Easy/APuzzle/'
        );

        self::assertFileExists($fileSystem->url() . '/tests/Easy/APuzzle/CGTest.php');
        self::assertStringEqualsFile(
            $fileSystem->url() . '/tests/Easy/APuzzle/CGTest.php',
            'modified-test'
        );
    }

    /**
     * Tests that the input file is not copied
     * if it already exist.
     */
    public function testDoNotCopyTheInputFileIfItAlreadyExist(): void
    {
        $configuration = new TestGeneratorConfiguration(
            'Easy\APuzzle',
            'A name',
            'anAlphanumName',
            new TestConfigurations()
        );

        $fileStructure = $this->getFileSystem();
        $fileStructure['tests'] = [
            'Easy' => [
                'APuzzle' => [
                    'input' => [
                        '01 - test file.txt' => 'modified-input'
                    ]
                ]
            ]
        ];
        $fileSystem = vfsStream::setup(structure: $fileStructure);

        $testGenerator = new CGTestGenerator(__DIR__ . '/../../templates/');
        $testGenerator->generate(
            $configuration,
            $fileSystem->url() . '/config/easy/APuzzle/',
            $fileSystem->url() . '/tests/Easy/APuzzle/'
        );

        self::assertFileExists($fileSystem->url() . '/tests/Easy/APuzzle/input/01 - test file.txt');
        self::assertStringEqualsFile(
            $fileSystem->url() . '/tests/Easy/APuzzle/input/01 - test file.txt',
            'modified-input'
        );
    }

    /**
     * Tests that the output file is not copied
     * if it already exist.
     */
    public function testDoNotCopyTheOutputFileIfItAlreadyExist(): void
    {
        $configuration = new TestGeneratorConfiguration(
            'Easy\APuzzle',
            'A name',
            'anAlphanumName',
            new TestConfigurations()
        );

        $fileStructure = $this->getFileSystem();
        $fileStructure['tests'] = [
            'Easy' => [
                'APuzzle' => [
                    'output' => [
                        '01 - test file.txt' => 'modified-output'
                    ]
                ]
            ]
        ];
        $fileSystem = vfsStream::setup(structure: $fileStructure);

        $testGenerator = new CGTestGenerator(__DIR__ . '/../../templates/');
        $testGenerator->generate(
            $configuration,
            $fileSystem->url() . '/config/easy/APuzzle/',
            $fileSystem->url() . '/tests/Easy/APuzzle/'
        );

        self::assertFileExists($fileSystem->url() . '/tests/Easy/APuzzle/output/01 - test file.txt');
        self::assertStringEqualsFile(
            $fileSystem->url() . '/tests/Easy/APuzzle/output/01 - test file.txt',
            'modified-output'
        );
    }
}
