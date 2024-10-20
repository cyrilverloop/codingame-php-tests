<?php

declare(strict_types=1);

namespace CyrilVerloop\Codingame\Tests\Parser;

use CyrilVerloop\Codingame\Parser\ParsedConfiguration;
use CyrilVerloop\Codingame\Configuration\TestConfigurations;
use PHPUnit\Framework\Attributes as PA;
use PHPUnit\Framework\TestCase;

/**
 * Tests for a configuration.
 */
#[
    PA\CoversClass(ParsedConfiguration::class),
    PA\UsesClass(TestConfigurations::class),
    PA\Group('cgpt'),
    PA\Group('cgpt_parser'),
    PA\Group('cgpt_parser_parsedConfiguration')
]
final class ParsedConfigurationTest extends TestCase
{
    // Methods :

    /**
     * Tests it has a namespace.
     */
    public function testHasANamespace(): void
    {
        $testconfigurations = new TestConfigurations();
        $configuration = new ParsedConfiguration(
            'path',
            'name',
            'alphanumName',
            'link',
            $testconfigurations
        );

        self::assertSame('path', $configuration->getpath());
    }

    /**
     * Tests it has a name.
     */
    public function testHasAName(): void
    {
        $testconfigurations = new TestConfigurations();
        $configuration = new ParsedConfiguration(
            'path',
            'name',
            'alphanumName',
            'link',
            $testconfigurations
        );

        self::assertSame('name', $configuration->getName());
    }

    /**
     * Tests it has an alphanumeric name.
     */
    public function testHasAnAlphanumName(): void
    {
        $testconfigurations = new TestConfigurations();
        $configuration = new ParsedConfiguration(
            'path',
            'name',
            'alphanumName',
            'link',
            $testconfigurations
        );

        self::assertSame('alphanumName', $configuration->getAlphanumName());
    }

    /**
     * Tests it has a link.
     */
    public function testHasALink(): void
    {
        $testconfigurations = new TestConfigurations();
        $configuration = new ParsedConfiguration(
            'path',
            'name',
            'alphanumName',
            'link',
            $testconfigurations
        );

        self::assertSame('link', $configuration->getLink());
    }

    /**
     * Tests it has test configurations.
     */
    public function testHasATestConfigurations(): void
    {
        $testconfigurations = new TestConfigurations();
        $configuration = new ParsedConfiguration(
            'path',
            'name',
            'alphanumName',
            'link',
            $testconfigurations
        );

        self::assertSame($testconfigurations, $configuration->getTestConfigurations());
    }
}
