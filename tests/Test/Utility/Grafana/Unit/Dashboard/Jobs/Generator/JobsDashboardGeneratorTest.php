<?php declare(strict_types=1);

namespace Test\Utility\Grafana\Unit\Dashboard\Jobs\Generator;

use PHPUnit\Framework\TestCase;
use Utility\Grafana\Dashboard\Jobs\Generator\JobsDashboardGenerator;

class JobsDashboardGeneratorTest extends TestCase
{
    public function testThatGenerateReturnsDashboardJsonString(): void
    {
        $testJobs = [
            // Test job 1
            [
                'name' => 'test-job-1',
                'command' => '$PHP_BIN vendor/bin/console some:command',
                'schedule' => '0 6 * * *',
                'enable' => true,
            ],
            // Test job 2
            [
                'name' => 'test-job-2',
                'command' => '$PHP_BIN vendor/bin/console some:command',
                'schedule' => '* * * * *',
                'enable' => false,
            ],
            // Test job 3
            [
                'name' => 'test-job-3',
                'command' => '$PHP_BIN vendor/bin/console some:command',
                'schedule' => '0 6 * * *',
                'enable' => true,
            ],
        ];
        $subjectUnderTest = new JobsDashboardGenerator();
        $actual = $subjectUnderTest->generate($testJobs);
        $expected = file_get_contents(__DIR__.'/Fixtures/expected-dashboard.json');

        $this->assertSame($expected, $actual);
    }
}
