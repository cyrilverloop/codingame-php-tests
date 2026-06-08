<?php

declare(strict_types=1);

namespace CyrilVerloop\Codingame\Tests\Configuration;

use CyrilVerloop\Codingame\Configuration\ConfigurationConvertor;
use CyrilVerloop\Codingame\Configuration\TestConfiguration;
use CyrilVerloop\Codingame\Configuration\TestConfigurations;
use CyrilVerloop\Codingame\Parser\ParsedConfiguration;
use CyrilVerloop\Codingame\Generator\CodeGeneratorConfiguration;
use CyrilVerloop\Codingame\Generator\TestConfiguration as TCGenerator;
use CyrilVerloop\Codingame\Generator\TestConfigurations as TCsGenerator;
use CyrilVerloop\Codingame\Generator\TestGeneratorConfiguration;
use PHPUnit\Framework\Attributes as PA;
use PHPUnit\Framework\TestCase;

/**
 * Tests for the configuration parser.
 */
#[
    PA\CoversClass(ConfigurationConvertor::class),
    PA\UsesClass(CodeGeneratorConfiguration::class),
    PA\UsesClass(ParsedConfiguration::class),
    PA\UsesClass(TCGenerator::class),
    PA\UsesClass(TCsGenerator::class),
    PA\UsesClass(TestConfiguration::class),
    PA\UsesClass(TestConfigurations::class),
    PA\UsesClass(TestGeneratorConfiguration::class),
    PA\Group('cgpt'),
    PA\Group('cgpt_configuration'),
    PA\Group('cgpt_configuration_configurationConvertor')
]
final class ConfigurationConvertorTest extends TestCase
{
    // Methods :

    /**
     * Tests that a RuntimeException is thrown
     * if the default code file is not readable.
     */
    public function testThrowsARuntimeExceptionIfTheDefaultCodeFileIsNotReadable(): void
    {
        $this->expectException(\RuntimeException::class);
        $this->expectExceptionMessageIs('defaultCodeFileNotReadable');

        $parsedTestConfiguration = new TestConfiguration(
            'A test name',
            'aTestAlphanumName',
            '01 - a test file.txt'
        );

        $parsedTestConfigurations = new TestConfigurations();
        $parsedTestConfigurations->add($parsedTestConfiguration);

        $parsedConfiguration = new ParsedConfiguration(
            'a/path',
            'A name',
            'anAlphanumName',
            'https://a-link',
            $parsedTestConfigurations
        );

        ConfigurationConvertor::getCodeGeneratorConfiguration($parsedConfiguration, '');
    }

    /**
     * Tests that a parsed configuration
     * can be converted to a code configuration.
     */
    public function testCanConvertAParsedConfigurationToACodeConfiguration(): void
    {
        $parsedTestConfiguration = new TestConfiguration(
            'A test name',
            'aTestAlphanumName',
            '01 - a test file.txt'
        );

        $parsedTestConfigurations = new TestConfigurations();
        $parsedTestConfigurations->add($parsedTestConfiguration);

        $parsedConfiguration = new ParsedConfiguration(
            'a/path',
            'A name',
            'anAlphanumName',
            'https://a-link',
            $parsedTestConfigurations
        );

        $codeConfiguration = ConfigurationConvertor::getCodeGeneratorConfiguration(
            $parsedConfiguration,
            __DIR__ . '/../Generator/Example/CGCode.dist'
        );

        self::assertSame('A\Path', $codeConfiguration->getNamespace());
        self::assertSame('A name', $codeConfiguration->getName());
        self::assertSame('https://a-link', $codeConfiguration->getLink());
        self::assertStringEqualsFile(
            __DIR__ . '/../Generator/Example/CGCodeIndented.dist',
            $codeConfiguration->getDefaultCode()
        );
    }


    /**
     * Tests that a parsed configuration
     * can be converted to a test configuration.
     */
    public function testCanConvertAParsedConfigurationToATestConfiguration(): void
    {
        $parsedTestConfiguration = new TestConfiguration(
            'A test name',
            'aTestAlphanumName',
            '01 - a test file.txt'
        );

        $parsedTestConfigurations = new TestConfigurations();
        $parsedTestConfigurations->add($parsedTestConfiguration);
        $parsedTestConfigurations->add($parsedTestConfiguration);

        $parsedConfiguration = new ParsedConfiguration(
            'a/path',
            'A name',
            'anAlphanumName',
            'https://a-link',
            $parsedTestConfigurations
        );

        $generatorTestConfiguration = ConfigurationConvertor::getTestGeneratorConfiguration($parsedConfiguration);

        self::assertSame('A\Path', $generatorTestConfiguration->getNamespace());
        self::assertSame('A name', $generatorTestConfiguration->getName());
        self::assertSame('anAlphanumName', $generatorTestConfiguration->getGroup());
        self::assertCount(2, $generatorTestConfiguration->getTestConfigurations());

        foreach ($generatorTestConfiguration->getTestConfigurations() as $testConfiguration) {
            self::assertSame('A test name', $testConfiguration->getName());
            self::assertSame('aTestAlphanumName', $testConfiguration->getGroup());
            self::assertSame('ATestAlphanumName', $testConfiguration->getMethod());
            self::assertSame('01 - a test file.txt', $testConfiguration->getFile());
        }
    }
}
