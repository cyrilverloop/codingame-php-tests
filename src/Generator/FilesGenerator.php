<?php

declare(strict_types=1);

namespace CyrilVerloop\Codingame\Generator;

use CyrilVerloop\Codingame\Configuration\ConfigurationConvertor;
use CyrilVerloop\Codingame\Generator\CGCodeGenerator;
use CyrilVerloop\Codingame\Generator\CGTestGenerator;
use CyrilVerloop\Codingame\Parser\ConfigurationParser;

/**
 * Generates the tests.
 */
final class FilesGenerator
{
    // Constants :

    /**
     * The configuration file.
     */
    private const string CONFIG_FILE = 'config.json';

    /**
     * The code directory.
     */
    private const string CODE_DIRECTORY = 'code' . DIRECTORY_SEPARATOR;

    /**
     * The source directory.
     */
    private const string SOURCE_DIRECTORY = 'src' . DIRECTORY_SEPARATOR;

    /**
     * The template directory.
     */
    private const string TEMPLATE_DIRECTORY = 'templates' . DIRECTORY_SEPARATOR;

    /**
     * The tests directory.
     */
    private const string TESTS_DIRECTORY = 'tests' . DIRECTORY_SEPARATOR;

    /**
     * The default code file.
     */
    private const string DEFAULT_CODE_FILE = 'CGCode.php';


    // Properties :

    /**
     * @var string the project path.
     */
    private string $projectPath;

    /**
     * @var \CyrilVerloop\Codingame\Parser\ConfigurationParser the configuration parser.
     */
    private ConfigurationParser $configurationParser;

    /**
     * @var \CyrilVerloop\Codingame\Generator\CGCodeGenerator the code generator.
     */
    private CGCodeGenerator $codeGenerator;

    /**
     * @var \CyrilVerloop\Codingame\Generator\CGTestGenerator the test generator.
     */
    private CGTestGenerator $testGenerator;


    // Magic methods :

    /**
     * The constructor.
     * @param string $projectPath the project path.
     */
    public function __construct(string $projectPath)
    {
        $this->projectPath = $projectPath;
        $this->configurationParser = new ConfigurationParser();
        $templatesPath = $projectPath . self::TEMPLATE_DIRECTORY;
        $this->codeGenerator = new CGCodeGenerator($templatesPath);
        $this->testGenerator = new CGTestGenerator($templatesPath);
    }


    // Methods :

    /**
     * Generates the test files.
     * @param string $pathToScan the path to scan for the configuration files.
     */
    public function generate(string $pathToScan): void
    {
        /**
         * @var string[] $difficulties
         */
        $difficulties = array_diff(scandir($pathToScan), ['.', '..']);

        foreach ($difficulties as $difficulty) {
            /**
             * @var string[] $configurations
             */
            $configurations = array_diff(scandir($pathToScan . $difficulty), ['.', '..']);
            $this->generateConfigurationsForDifficulty(
                $configurations,
                $difficulty,
                $pathToScan . $difficulty . DIRECTORY_SEPARATOR
            );
        }
    }

    /**
     * Generates the configurations for the difficulty.
     * @param string[] $configurations the configurations.
     * @param string $difficulty the difficulty.
     * @param string $difficultyPathToScan the path to scan for a configuration file.
     */
    private function generateConfigurationsForDifficulty(
        array $configurations,
        string $difficulty,
        string $difficultyPathToScan
    ): void {
        foreach ($configurations as $configuration) {
            $configurationPath = $difficultyPathToScan . $configuration . DIRECTORY_SEPARATOR;
            $defaultCodeFile = $configurationPath . self::CODE_DIRECTORY . self::DEFAULT_CODE_FILE;

            if (file_exists($defaultCodeFile) === true) {
                $this->generateFilesForConfiguration(
                    $configurationPath,
                    ucfirst($difficulty) . DIRECTORY_SEPARATOR . $configuration . DIRECTORY_SEPARATOR
                );
            }
        }
    }

    /**
     * Generates the files for the configuration.
     * @param string $configurationPath the path of the `config` directory.
     * @param string $namespacePath the path where to generate the files.
     */
    private function generateFilesForConfiguration(
        string $configurationPath,
        string $namespacePath
    ): void {
        $parsedConfiguration = $this->configurationParser->getConfigurationFromFile($configurationPath . self::CONFIG_FILE);

        $codeConfiguration = ConfigurationConvertor::getCodeGeneratorConfiguration(
            $parsedConfiguration,
            $configurationPath . self::CODE_DIRECTORY . self::DEFAULT_CODE_FILE
        );

        $this->codeGenerator->generate(
            $codeConfiguration,
            $this->projectPath . self::SOURCE_DIRECTORY . $namespacePath
        );

        $testConfiguration = ConfigurationConvertor::getTestGeneratorConfiguration($parsedConfiguration);
        $this->testGenerator->generate(
            $testConfiguration,
            $configurationPath,
            $this->projectPath . self::TESTS_DIRECTORY . $namespacePath
        );
    }
}
