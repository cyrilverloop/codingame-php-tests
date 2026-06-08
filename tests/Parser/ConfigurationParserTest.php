<?php

declare(strict_types=1);

namespace CyrilVerloop\Codingame\Tests\Parser;

use CyrilVerloop\Codingame\Parser\ConfigurationParser;
use CyrilVerloop\Codingame\Parser\ParsedConfiguration;
use CyrilVerloop\Codingame\Configuration\TestConfiguration;
use CyrilVerloop\Codingame\Configuration\TestConfigurations;
use org\bovigo\vfs\vfsStream;
use PHPUnit\Framework\Attributes as PA;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the configuration parser.
 */
#[
    PA\CoversClass(ConfigurationParser::class),
    PA\UsesClass(ParsedConfiguration::class),
    PA\UsesClass(TestConfiguration::class),
    PA\UsesClass(TestConfigurations::class),
    PA\Group('cgpt'),
    PA\Group('cgpt_parser'),
    PA\Group('cgpt_parser_configurationParser')
]
final class ConfigurationParserTest extends TestCase
{
    // Methods :

    /**
     * Tests that a runtime exception is thrown
     * when the file does not exist.
     */
    public function testThrowsARuntimeExceptionWhenTheFileDoesNotExist(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessageIs('fileNotReadable');

        $fileSystem = vfsStream::setup('', null, []);

        $ConfigurationParser = new ConfigurationParser();
        $ConfigurationParser->getConfigurationFromFile($fileSystem->url() . '/config.json');
    }

    /**
     * Tests that a json exception is thrown
     * when the json is invalid.
     */
    public function testThrowsAJsonExceptionWhenTheJsonIsInvalid(): void
    {
        $this->expectException(\JsonException::class);

        $fileStructure = [
            'config.json' => '{'
        ];
        $fileSystem = vfsStream::setup('', null, $fileStructure);

        $ConfigurationParser = new ConfigurationParser();
        $ConfigurationParser->getConfigurationFromFile($fileSystem->url() . '/config.json');
    }


    /**
     * Returns the test structure.
     * @return array the test structure.
     */
    private function getTestStructure(): array
    {
        return [
            'name' => 'a-test-name',
            'alphanumName' => 'a-test-alphanumName',
            'file' => 'a-test-file'
        ];
    }

    /**
     * Returns the configuration.
     * @return array the configuration.
     */
    private function getConfiguration(): array
    {
        return [
            'path' => 'a/path',
            'name' => 'a-name',
            'alphanumName' => 'an-alphanumName',
            'link' => 'a-link',
            'tests' => [
                json_decode(json_encode($this->getTestStructure()))
            ],
        ];
    }

    /**
     * Tests that a runtime exception is thrown
     * if the path is not a string.
     */
    public function testThrowsAnUnexpectedValueExceptionIfThePathIsNotAString(): void
    {
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessageIs('pathNotAString');

        $configuration = $this->getConfiguration();
        $configuration['path'] = 123;
        $fileStructure = [
            'config.json' => json_encode($configuration)
        ];
        $fileSystem = vfsStream::setup('', null, $fileStructure);

        $ConfigurationParser = new ConfigurationParser();
        $ConfigurationParser->getConfigurationFromFile($fileSystem->url() . '/config.json');
    }

    /**
     * Tests that a runtime exception is thrown
     * if the name is not a string.
     */
    public function testThrowsAnUnexpectedValueExceptionIfTheNameIsNotAString(): void
    {
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessageIs('nameNotAString');

        $configuration = $this->getConfiguration();
        $configuration['name'] = 123;
        $fileStructure = [
            'config.json' => json_encode($configuration)
        ];
        $fileSystem = vfsStream::setup('', null, $fileStructure);

        $ConfigurationParser = new ConfigurationParser();
        $ConfigurationParser->getConfigurationFromFile($fileSystem->url() . '/config.json');
    }

    /**
     * Tests that a runtime exception is thrown
     * if the alphanumeric name is not a string.
     */
    public function testThrowsAnUnexpectedValueExceptionIfTheAlphanumNameIsNotAString(): void
    {
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessageIs('alphanumNameNotAString');

        $configuration = $this->getConfiguration();
        $configuration['alphanumName'] = 123;
        $fileStructure = [
            'config.json' => json_encode($configuration)
        ];
        $fileSystem = vfsStream::setup('', null, $fileStructure);

        $ConfigurationParser = new ConfigurationParser();
        $ConfigurationParser->getConfigurationFromFile($fileSystem->url() . '/config.json');
    }

    /**
     * Tests that a runtime exception is thrown
     * if the link is not a string.
     */
    public function testThrowsAnUnexpectedValueExceptionIfTheLinkIsNotAString(): void
    {
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessageIs('linkNotAString');

        $configuration = $this->getConfiguration();
        $configuration['link'] = 123;
        $fileStructure = [
            'config.json' => json_encode($configuration)
        ];
        $fileSystem = vfsStream::setup('', null, $fileStructure);

        $ConfigurationParser = new ConfigurationParser();
        $ConfigurationParser->getConfigurationFromFile($fileSystem->url() . '/config.json');
    }

    /**
     * Tests that a runtime exception is thrown
     * if the tests are not an array.
     */
    public function testThrowsAnUnexpectedValueExceptionIfTheTestsAreNotAnArray(): void
    {
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessageIs('testsNotAnArray');

        $configuration = $this->getConfiguration();
        $configuration['tests'] = 123;
        $fileStructure = [
            'config.json' => json_encode($configuration)
        ];
        $fileSystem = vfsStream::setup('', null, $fileStructure);

        $ConfigurationParser = new ConfigurationParser();
        $ConfigurationParser->getConfigurationFromFile($fileSystem->url() . '/config.json');
    }

    /**
     * Tests that a runtime exception is thrown
     * if the test name is not a string.
     */
    public function testThrowsAnUnexpectedValueExceptionIfTheTestNameIsNotAString(): void
    {
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessageIs('testNameNotAString');

        $configuration = $this->getConfiguration();
        $testConfiguration = $this->getTestStructure();
        $testConfiguration['name'] = 123;
        $configuration['tests'] = [$testConfiguration];
        $fileStructure = [
            'config.json' => json_encode($configuration)
        ];
        $fileSystem = vfsStream::setup('', null, $fileStructure);

        $ConfigurationParser = new ConfigurationParser();
        $ConfigurationParser->getConfigurationFromFile($fileSystem->url() . '/config.json');
    }

    /**
     * Tests that a runtime exception is thrown
     * if the test method is not a string.
     */
    public function testThrowsAnUnexpectedValueExceptionIfTheTestMethodIsNotAString(): void
    {
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessageIs('testAlphanumNameNotAString');

        $configuration = $this->getConfiguration();
        $testConfiguration = $this->getTestStructure();
        $testConfiguration['alphanumName'] = 123;
        $configuration['tests'] = [$testConfiguration];
        $fileStructure = [
            'config.json' => json_encode($configuration)
        ];
        $fileSystem = vfsStream::setup('', null, $fileStructure);

        $ConfigurationParser = new ConfigurationParser();
        $ConfigurationParser->getConfigurationFromFile($fileSystem->url() . '/config.json');
    }

    /**
     * Tests that a runtime exception is thrown
     * if the test file is not a string.
     */
    public function testThrowsAnUnexpectedValueExceptionIfTheTestFileIsNotAString(): void
    {
        $this->expectException(\UnexpectedValueException::class);
        $this->expectExceptionMessageIs('testFileNotAString');

        $configuration = $this->getConfiguration();
        $testConfiguration = $this->getTestStructure();
        $testConfiguration['file'] = 123;
        $configuration['tests'] = [$testConfiguration];
        $fileStructure = [
            'config.json' => json_encode($configuration)
        ];
        $fileSystem = vfsStream::setup('', null, $fileStructure);

        $ConfigurationParser = new ConfigurationParser();
        $ConfigurationParser->getConfigurationFromFile($fileSystem->url() . '/config.json');
    }


    /**
     * Tests that a configuration file with one test can be parsed.
     */
    public function testCanParseAOneTestConfigurationFromFile(): void
    {
        $fileStructure = [
            'config.json' => json_encode($this->getConfiguration())
        ];
        $fileSystem = vfsStream::setup('', null, $fileStructure);

        $ConfigurationParser = new ConfigurationParser();
        $Configuration = $ConfigurationParser->getConfigurationFromFile($fileSystem->url() . '/config.json');

        self::assertSame('a/path', $Configuration->getPath());
        self::assertSame('a-name', $Configuration->getName());
        self::assertSame('an-alphanumName', $Configuration->getAlphanumName());
        self::assertSame('a-link', $Configuration->getLink());

        $testConfigurations = $Configuration->getTestConfigurations();

        self::assertCount(1, $testConfigurations);

        $testConfiguration = $testConfigurations->current();

        self::assertSame('a-test-name', $testConfiguration->getName());
        self::assertSame('a-test-alphanumName', $testConfiguration->getAlphanumName());
        self::assertSame('a-test-file', $testConfiguration->getFile());
    }

    /**
     * Tests that a configuration file with two tests can be parsed.
     */
    public function testCanParseATwoTestsConfigurationFromFile(): void
    {
        $configuration = $this->getConfiguration();
        $configuration['tests'][] = $this->getTestStructure();
        $fileStructure = [
            'config.json' => json_encode($configuration)
        ];
        $fileSystem = vfsStream::setup('', null, $fileStructure);

        $ConfigurationParser = new ConfigurationParser();
        $Configuration = $ConfigurationParser->getConfigurationFromFile($fileSystem->url() . '/config.json');

        self::assertSame('a/path', $Configuration->getPath());
        self::assertSame('a-name', $Configuration->getName());
        self::assertSame('an-alphanumName', $Configuration->getAlphanumName());
        self::assertSame('a-link', $Configuration->getLink());

        $testConfigurations = $Configuration->getTestConfigurations();

        self::assertCount(2, $testConfigurations);

        self::assertFalse($testConfigurations->currentIsLast());

        foreach ($testConfigurations as $testConfiguration) {
            self::assertSame('a-test-name', $testConfiguration->getName());
            self::assertSame('a-test-alphanumName', $testConfiguration->getAlphanumName());
            self::assertSame('a-test-file', $testConfiguration->getFile());
        }
    }
}
