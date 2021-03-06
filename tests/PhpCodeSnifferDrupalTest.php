<?php

namespace OpenEuropa\CodeReview\Tests;

use GrumPHP\Collection\FilesCollection;
use GrumPHP\Task\Context\RunContext;

/**
 * Tests the PHP_CodeSniffer task using the Drupal conventions.
 */
class PhpCodeSnifferDrupalTest extends PhpCodeSnifferTestBase
{
    /**
     * Tests Drupal code to make sure CodeSniffer triggers the appropriate errors.
     *
     * @param string $fixture
     *   Name of the fixture.
     * @param string $configuration
     *   The name of the configuration to use in the task
     * @param array  $expected
     *   Expected result after the test.
     *
     * @dataProvider dataProvider
     */
    public function testDrupalPhpCodeSnifferDetector(string $fixture, string $configuration, array $expected): void
    {
        $collection = new FilesCollection([$this->getFixture($fixture)]);
        $context = new RunContext($collection);
        $result = $this->runTask($configuration, 'phpcs', $context);
        $this->assertEquals($expected, $this->getFailures($result->first()));
    }

    /**
     * Provides test cases for testing the PHP_CodeSniffer task for Drupal.
     *
     * @return array
     *      Test data.
     */
    public function dataProvider()
    {
        return [
            [
                'phpcs/DrupalClass.php',
                'drupal-conventions',
                [
                    'error' => [
                        18 => 1,
                    ],
                ],
            ],
            [
                'phpcs/drupal.inc',
                'drupal-conventions',
                [
                    'error' => [
                        1 => 1,
                        9 => 2,
                    ],
                    'warning' => [
                        3 => 1,
                    ],
                ],
            ],
            [
                'phpcs/drupal.install',
                'drupal-conventions',
                [
                    'error' => [
                        1 => 1,
                        9 => 2,
                    ],
                    'warning' => [
                        3 => 1,
                    ],
                ],
            ],
            [
                'phpcs/drupal.module',
                'drupal-conventions',
                [
                    'error' => [
                        1 => 1,
                        9 => 2,
                    ],
                    'warning' => [
                        3 => 1,
                    ],
                ],
            ],
            [
                'phpcs/drupal.profile',
                'drupal-conventions',
                [
                    'error' => [
                        1 => 1,
                        9 => 2,
                    ],
                    'warning' => [
                        3 => 1,
                    ],
                ],
            ],
            [
                'phpcs/drupal.theme',
                'drupal-conventions',
                [
                    'error' => [
                        1 => 1,
                        9 => 2,
                    ],
                    'warning' => [
                        3 => 1,
                    ],
                ],
            ],
        ];
    }
}
