#!/usr/bin/env php
<?php

use React\EventLoop\Loop;
use React\Http\Message\Response;
use React\Http\HttpServer;
use React\Socket\SocketServer;

require(__DIR__ . '/../vendor/autoload.php');

$loop = Loop::get();

$server = new HttpServer($loop, static function () {
    $output = 'Hello World! '
        . PHP_EOL . 'Date : ' . \date('Y-m-d H:i:s')
        . PHP_EOL . @\file_get_contents('/vault/foo')
        . PHP_EOL . @\file_get_contents('/vault/bar')
        . PHP_EOL . ($_ENV['KEY1'] ?? '')
        . PHP_EOL . ($_ENV['KEY2'] ?? '')
        . PHP_EOL . @\file_get_contents('/opt/data/output');

    if (\file_exists('/opt/extra/extra/run.php')) {
        $output .= PHP_EOL . include('/opt/extra/extra/run.php');
    }

    @\file_put_contents('/opt/data/output', time());

    return new Response(
        200,
        [
            'Content-Type' => 'text/plain'
        ],
        $output
    );
});

$socket = new SocketServer('0.0.0.0:8080', [], $loop);
$server->listen($socket);

echo 'Server running at http://127.0.0.1:8080' . PHP_EOL;

$loop->run();
