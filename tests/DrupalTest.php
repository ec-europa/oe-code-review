<?php

namespace OpenEuropa\CodeReview\Tests;

use GrumPHP\Runner\TaskResult;
use GrumPHP\Collection\FilesCollection;
use GrumPHP\Task\Context\GitPreCommitContext;

/**
 * Tests for Drupal conventions.
 */
class DrupalTest extends AbstractTest
{

    /**
     * Tests different git messages against the predefined conventions.
     *
     * @param string $fixture
     *   Name of the fixture.
     * @param int    $expected
     *   Expected result after the test.
     *
     * @dataProvider commitMessageProvider
     */
    public function testPhpMessDetector($fixture, $expected)
    {
        $collection = new FilesCollection([$this->getFixture($fixture)]);
        $context = new GitPreCommitContext($collection);
        $task = $this->getTask('phpmd', 'drupal-conventions');
        $result = $task->run($context);
        $this->assertEquals($expected, $result->getResultCode());
    }

    /**
     * Test case provider function.
     *
     * Test file extensions.
     *
     * @return array
     *      Test data.
     */
    public function commitMessageProvider()
    {
        return [
          ['phpmd/correct-code.inc', TaskResult::PASSED],
          ['phpmd/correct-code.module', TaskResult::PASSED],
          ['phpmd/correct-code.theme', TaskResult::PASSED],
          ['phpmd/ignored-code.xxx', TaskResult::SKIPPED],
        ];
    }
}
