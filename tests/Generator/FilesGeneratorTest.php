<?php

declare(strict_types=1);

namespace CyrilVerloop\Codingame\Tests\Generator;

use CyrilVerloop\Codingame\Configuration\ConfigurationConvertor;
use CyrilVerloop\Codingame\Configuration\TestConfiguration;
use CyrilVerloop\Codingame\Configuration\TestConfigurations;
use CyrilVerloop\Codingame\Generator\CGCodeGenerator;
use CyrilVerloop\Codingame\Generator\CGTestGenerator;
use CyrilVerloop\Codingame\Generator\FileGenerator;
use CyrilVerloop\Codingame\Generator\FilesGenerator;
use CyrilVerloop\Codingame\Generator\CodeGeneratorConfiguration;
use CyrilVerloop\Codingame\Generator\TestConfiguration as TCGenerator;
use CyrilVerloop\Codingame\Generator\TestConfigurations as TCsGenerator;
use CyrilVerloop\Codingame\Generator\TestGeneratorConfiguration;
use CyrilVerloop\Codingame\Parser\ConfigurationParser;
use CyrilVerloop\Codingame\Parser\ParsedConfiguration;
use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\Attributes as PA;
use PHPUnit\Framework\TestCase;

/**
 * Tests the files generator.
 */
#[
    PA\CoversClass(FilesGenerator::class),
    PA\UsesClass(CGCodeGenerator::class),
    PA\UsesClass(CGTestGenerator::class),
    PA\UsesClass(CodeGeneratorConfiguration::class),
    PA\UsesClass(ConfigurationConvertor::class),
    PA\UsesClass(ConfigurationParser::class),
    PA\UsesClass(FileGenerator::class),
    PA\UsesClass(ParsedConfiguration::class),
    PA\UsesClass(TCGenerator::class),
    PA\UsesClass(TCsGenerator::class),
    PA\UsesClass(TestConfiguration::class),
    PA\UsesClass(TestConfigurations::class),
    PA\UsesClass(TestGeneratorConfiguration::class),
    PA\Group('cgpt'),
    PA\Group('cgpt_generator'),
    PA\Group('cgpt_generator_codeAndTestGenerator')
]
final class FilesGeneratorTest extends TestCase
{
    // Methods :

    /**
     * Returns the file structure.
     * @return mixed[] the file structure.
     */
    public function getFileStructure(): array
    {
        $CGCodeContent = file_get_contents(__DIR__ . '/Example/CGCode.dist');
        $inputFileContent = file_get_contents(__DIR__ . '/Example/input/01 - test file.txt');
        $inputFile2Content = file_get_contents(__DIR__ . '/Example/input/02 - test file 2.txt');
        $outputFileContent = file_get_contents(__DIR__ . '/Example/output/01 - test file.txt');
        $outputFile2Content = file_get_contents(__DIR__ . '/Example/output/02 - test file 2.txt');
        $configContent = file_get_contents(__DIR__ . '/Example/config.json');

        return [
            'vendor' => [
                'cyril-verloop' => [
                    'codingame-configuration' => [
                        'config' => [
                            'easy' => [
                                'APuzzle' => [
                                    'code' => [
                                        'CGCode.php' => $CGCodeContent
                                    ],
                                    'input' => [
                                        '01 - test file.txt' => $inputFileContent,
                                        '02 - test file 2.txt' => $inputFile2Content
                                    ],
                                    'output' => [
                                        '01 - test file.txt' => $outputFileContent,
                                        '02 - test file 2.txt' => $outputFile2Content
                                    ],
                                    'config.json' => $configContent
                                ],
                                'APuzzle2' => [
                                    'code' => [
                                        'CGCode.php' => $CGCodeContent
                                    ],
                                    'input' => [
                                        '01 - test file.txt' => $inputFileContent,
                                        '02 - test file 2.txt' => $inputFile2Content
                                    ],
                                    'output' => [
                                        '01 - test file.txt' => $outputFileContent,
                                        '02 - test file 2.txt' => $outputFile2Content
                                    ],
                                    'config.json' => $configContent
                                ]
                            ]
                        ]
                    ]
                ]
            ]
        ];
    }


    /**
     * Tests that the code will not be generated
     * if it already exist.
     */
    public function testWillNotEraseExistingCodeFile(): void
    {
        $fileStructure = $this->getFileStructure();
        $fileStructure['src'] = [
            'Easy' => [
                'APuzzle' => [
                    'CGCode.php' => 'modified-code'
                ],
                'APuzzle2' => [
                    'CGCode.php' => 'modified-code2'
                ]
            ]
        ];
        vfsStream::setup(structure: $fileStructure);

        $filesGenerator = new FilesGenerator(__DIR__ . '/../../templates/');
        $filesGenerator->generate(
            vfsStream::url('root/vendor/cyril-verloop/codingame-configuration/config/'),
            vfsStream::url('root/src/'),
            vfsStream::url('root/tests/')
        );

        self::assertFileExists(vfsStream::url('root/src/Easy/APuzzle/CGCode.php'));
        self::assertStringEqualsFile(
            vfsStream::url('root/src/Easy/APuzzle/CGCode.php'),
            'modified-code'
        );

        self::assertFileExists(vfsStream::url('root/src/Easy/APuzzle2/CGCode.php'));
        self::assertStringEqualsFile(
            vfsStream::url('root/src/Easy/APuzzle2/CGCode.php'),
            'modified-code2'
        );
    }

    /**
     * Tests that the code can be generated.
     */
    public function testCanGenerateTheCode(): void
    {
        $fileStructure = $this->getFileStructure();
        vfsStream::setup(structure: $fileStructure);

        $filesGenerator = new FilesGenerator(__DIR__ . '/../../templates/');
        $filesGenerator->generate(
            vfsStream::url('root/vendor/cyril-verloop/codingame-configuration/config/'),
            vfsStream::url('root/src/'),
            vfsStream::url('root/tests/')
        );

        self::assertFileExists(
            vfsStream::url('root/src/Easy/APuzzle/CGCode.php'),
            'The code file for APuzzle has not been generated.'
        );

        self::assertFileExists(
            vfsStream::url('root/src/Easy/APuzzle2/CGCode.php'),
            'The code file for APuzzle2 has not been generated.'
        );
    }


    /**
     * Tests that the test will not be generated
     * if it already exist.
     */
    public function testWillNotEraseExistingTestFile(): void
    {
        $fileStructure = $this->getFileStructure();
        $fileStructure['tests'] = [
            'Easy' => [
                'APuzzle' => [
                    'CGTest.php' => 'modified-test'
                ],
                'APuzzle2' => [
                    'CGTest.php' => 'modified-test2'
                ]
            ]
        ];
        vfsStream::setup(structure: $fileStructure);

        $filesGenerator = new FilesGenerator(__DIR__ . '/../../templates/');
        $filesGenerator->generate(
            vfsStream::url('root/vendor/cyril-verloop/codingame-configuration/config/'),
            vfsStream::url('root/src/'),
            vfsStream::url('root/tests/')
        );

        self::assertFileExists(vfsStream::url('root/tests/Easy/APuzzle/CGTest.php'));
        self::assertStringEqualsFile(
            vfsStream::url('root/tests/Easy/APuzzle/CGTest.php'),
            'modified-test'
        );

        self::assertFileExists(vfsStream::url('root/tests/Easy/APuzzle2/CGTest.php'));
        self::assertStringEqualsFile(
            vfsStream::url('root/tests/Easy/APuzzle2/CGTest.php'),
            'modified-test2'
        );
    }

    /**
     * Tests that the test can be generated.
     */
    public function testCanGenerateTheTest(): void
    {
        $fileStructure = $this->getFileStructure();
        vfsStream::setup(structure: $fileStructure);

        $filesGenerator = new FilesGenerator(__DIR__ . '/../../templates/');
        $filesGenerator->generate(
            vfsStream::url('root/vendor/cyril-verloop/codingame-configuration/config/'),
            vfsStream::url('root/src/'),
            vfsStream::url('root/tests/')
        );

        self::assertFileExists(
            vfsStream::url('root/tests/Easy/APuzzle/CGTest.php'),
            'The test file for APuzzle has not been generated.'
        );

        self::assertFileExists(
            vfsStream::url('root/tests/Easy/APuzzle2/CGTest.php'),
            'The test file for APuzzle2 has not been generated.'
        );
    }


    /**
     * Tests that the input files will not be copied
     * if it already exist.
     */
    public function testWillNotEraseExistingInputFiles(): void
    {
        $fileStructure = $this->getFileStructure();
        $fileStructure['tests'] = [
            'Easy' => [
                'APuzzle' => [
                    'input' => [
                        '01 - test file.txt' => 'modified-input1',
                    ]
                ]
            ]
        ];
        vfsStream::setup(structure: $fileStructure);

        $filesGenerator = new FilesGenerator(__DIR__ . '/../../templates/');
        $filesGenerator->generate(
            vfsStream::url('root/vendor/cyril-verloop/codingame-configuration/config/'),
            vfsStream::url('root/src/'),
            vfsStream::url('root/tests/')
        );

        self::assertFileExists(vfsStream::url('root/tests/Easy/APuzzle/input/01 - test file.txt'));
        self::assertStringEqualsFile(
            vfsStream::url('root/tests/Easy/APuzzle/input/01 - test file.txt'),
            'modified-input1'
        );
    }

    /**
     * Tests that the input files can be copied.
     */
    public function testCanCopyTheInputFiles(): void
    {
        $fileStructure = $this->getFileStructure();
        vfsStream::setup(structure: $fileStructure);

        $filesGenerator = new FilesGenerator(__DIR__ . '/../../templates/');
        $filesGenerator->generate(
            vfsStream::url('root/vendor/cyril-verloop/codingame-configuration/config/'),
            vfsStream::url('root/src/'),
            vfsStream::url('root/tests/')
        );

        self::assertFileExists(
            vfsStream::url('root/tests/Easy/APuzzle/input/01 - test file.txt'),
            'The input file "01 - test file.txt" for APuzzle has not been copied.'
        );

        self::assertFileExists(
            vfsStream::url('root/tests/Easy/APuzzle/input/02 - test file 2.txt'),
            'The input file "02 - test file 2.txt" for APuzzle has not been copied.'
        );

        self::assertFileExists(
            vfsStream::url('root/tests/Easy/APuzzle2/input/01 - test file.txt'),
            'The input file "01 - test file.txt" for APuzzle2 has not been copied.'
        );

        self::assertFileExists(
            vfsStream::url('root/tests/Easy/APuzzle2/input/02 - test file 2.txt'),
            'The input file "02 - test file 2.txt" for APuzzle2 has not been copied.'
        );
    }


    /**
     * Tests that the output files will not be copied
     * if it already exist.
     */
    public function testWillNotEraseExistingOutputFiles(): void
    {
        $fileStructure = $this->getFileStructure();
        $fileStructure['tests'] = [
            'Easy' => [
                'APuzzle2' => [
                    'output' => [
                        '02 - test file 2.txt' => 'modified-output2'
                    ]
                ]
            ]
        ];
        vfsStream::setup(structure: $fileStructure);

        $filesGenerator = new FilesGenerator(__DIR__ . '/../../templates/');
        $filesGenerator->generate(
            vfsStream::url('root/vendor/cyril-verloop/codingame-configuration/config/'),
            vfsStream::url('root/src/'),
            vfsStream::url('root/tests/')
        );

        self::assertFileExists(vfsStream::url('root/tests/Easy/APuzzle2/output/02 - test file 2.txt'));
        self::assertStringEqualsFile(
            vfsStream::url('root/tests/Easy/APuzzle2/output/02 - test file 2.txt'),
            'modified-output2'
        );
    }

    /**
     * Tests that the output files can be copied.
     */
    public function testCanCopyTheOutputFiles(): void
    {
        $fileStructure = $this->getFileStructure();
        vfsStream::setup(structure: $fileStructure);

        $filesGenerator = new FilesGenerator(__DIR__ . '/../../templates/');
        $filesGenerator->generate(
            vfsStream::url('root/vendor/cyril-verloop/codingame-configuration/config/'),
            vfsStream::url('root/src/'),
            vfsStream::url('root/tests/')
        );

        self::assertFileExists(
            vfsStream::url('root/tests/Easy/APuzzle/output/01 - test file.txt'),
            'The output file "01 - test file.txt" for APuzzle has not been copied.'
        );

        self::assertFileExists(
            vfsStream::url('root/tests/Easy/APuzzle/output/02 - test file 2.txt'),
            'The output file "02 - test file 2.txt" for APuzzle has not been copied.'
        );

        self::assertFileExists(
            vfsStream::url('root/tests/Easy/APuzzle2/output/01 - test file.txt'),
            'The output file "01 - test file.txt" for APuzzle2 has not been copied.'
        );

        self::assertFileExists(
            vfsStream::url('root/tests/Easy/APuzzle2/output/02 - test file 2.txt'),
            'The output file "02 - test file 2.txt" for APuzzle2 has not been copied.'
        );
    }
}
