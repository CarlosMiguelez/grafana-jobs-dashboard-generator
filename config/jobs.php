<?php declare(strict_types = 1);

// Cron jobs configuration
$jobs = [
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
    // Test job 4
    [
        'name' => 'test-job-4',
        'command' => '$PHP_BIN vendor/bin/console some:command',
        'schedule' => '* * * * *',
        'enable' => true,
    ],
    // Test job 5
    [
        'name' => 'test-job-5',
        'command' => '$PHP_BIN vendor/bin/console some:command',
        'schedule' => '30 2 * * *',
        'enable' => true,
    ],
    // Test job 6
    [
        'name' => 'test-job-6',
        'command' => '$PHP_BIN vendor/bin/console some:command',
        'schedule' => '*/5 * * * *',
        'enable' => true,
    ],
    // Test job 7
    [
        'name' => 'test-job-7',
        'command' => '$PHP_BIN vendor/bin/console deactivate-discontinued-products',
        'schedule' => '0 0 * * *',
        'enable' => false,
    ],
    // Test job 8
    [
        'name' => 'test-job-8',
        'command' => '$PHP_BIN vendor/bin/console some:command',
        'schedule' => '*/5 * * * *',
        'enable' => true,
    ],
    // Test job 9
    [
        'name' => 'test-job-9',
        'command' => '$PHP_BIN vendor/bin/console some:command',
        'schedule' => '30 1 * * *',
        'enable' => true,
    ],
    // Test job 10
    [
        'name' => 'test-job-10',
        'command' => '$PHP_BIN vendor/bin/console some:command',
        'schedule' => '0 * * * *',
        'enable' => false,
    ],
];
