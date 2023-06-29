#!/usr/bin/env php
<?php

use React\EventLoop\Loop;
use React\Http\Message\Response;
use React\Http\HttpServer;
use React\Socket\SocketServer;

require(__DIR__ . '/../vendor/autoload.php');

$loop = Loop::get();

$server = new HttpServer($loop, static function () {
    $extra = 'Missing extra';
    if (\file_exists('/opt/extra/extra/run.php')) {
        $extra = 'extra : ' . include('/opt/extra/extra/run.php');
    }

    $output = 'Hello World! '
        . PHP_EOL . 'Demo v22.12.10.03'
        . PHP_EOL . 'Date : ' . \date('Y-m-d H:i:s')
        . PHP_EOL . 'volume-vault.foo : ' . @\file_get_contents('/vault/foo')
        . PHP_EOL . 'volume-vault.bar : ' . @\file_get_contents('/vault/bar')
        . PHP_EOL . 'map-vault.key1 : ' . ($_ENV['KEY1'] ?? '')
        . PHP_EOL . 'map-vault.key2 : ' . ($_ENV['KEY2'] ?? '')
        . PHP_EOL . 'output : ' . @\file_get_contents('/opt/data/output')
        . PHP_EOL . $extra;

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
