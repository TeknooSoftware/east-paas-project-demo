#!/usr/bin/env php
<?php

use React\EventLoop\Factory;
use React\Http\Message\Response;
use React\Http\Server as HttpServer;
use React\Socket\Server as SocketServer;

require(__DIR__ . '/../vendor/autoload.php');

$loop = Factory::create();

$server = new HttpServer($loop, static function () {
    $output = 'Hello World! '
        . PHP_EOL . 'Date : ' . \date('Y-m-d H:i:s')
        . PHP_EOL . \print_r($_ENV, true)
        . PHP_EOL . include ('/opt/extra/extra/run.php');

    \file_put_contents('/opt/data/output', $output);

    return new Response(
        200,
        [
            'Content-Type' => 'text/plain'
        ],
        $output
    );
});

$socket = new SocketServer('0.0.0.0:8080', $loop);
$server->listen($socket);

echo 'Server running at http://127.0.0.1:8080' . PHP_EOL;

$loop->run();
