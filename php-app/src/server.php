#!/usr/bin/env php
<?php

declare(strict_types=1);

namespace Teknoo\Space\Demo\App;

use React\EventLoop\Loop;
use React\Http\Message\Response;
use React\Http\HttpServer;
use React\Socket\SocketServer;
use Throwable;

require __DIR__ . '/../vendor/autoload.php';

$loop = Loop::get();

$server = new HttpServer($loop, static function () {
    try {
        $extra = 'Missing extra';
        if (file_exists('/opt/extra/run.php')) {
            $extra = 'extra : ' . include('/opt/extra/run.php');
        }

        $now = (new DateTimeImmutable())->format('Y-m-d H:i:s');
        $output = 'Hello World from PHP! '
            . PHP_EOL . 'Demo v23.11.12.01'
            . PHP_EOL . 'Date : ' . $now
            . PHP_EOL . 'volume-vault.foo : ' . @file_get_contents('/vault/foo')
            . PHP_EOL . 'volume-vault.bar : ' . @file_get_contents('/vault/bar')
            . PHP_EOL . 'map-vault.key1 : ' . ($_ENV['KEY1'] ?? '')
            . PHP_EOL . 'map-vault.key2 : ' . ($_ENV['KEY2'] ?? '')
            . PHP_EOL . 'from output : ' . @file_get_contents('/mnt/data/output')
            . PHP_EOL . 'from job : ' . @file_get_contents('/mnt/job/init')
            . PHP_EOL . 'from cron : ' . @file_get_contents('/mnt/job/output')
            . PHP_EOL . $extra;

        @file_put_contents('/mnt/data/output', 'Last visite at ' . $now);

        return new Response(
            200,
            [
                'Content-Type' => 'text/plain'
            ],
            $output
        );
    } catch (Throwable $e) {
        return new Response(
            500,
            [
                'Content-Type' => 'text/plain'
            ],
            $e->getMessage(),
        );
    }
});

$socket = new SocketServer('0.0.0.0:8080', [], $loop);
$server->listen($socket);

echo 'Server running at http://127.0.0.1:8080' . PHP_EOL;

$loop->run();
