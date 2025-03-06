#!/usr/bin/env php
<?php

declare(strict_types=1);

namespace Teknoo\Space\Demo\Job;

use DateTimeImmutable;

$now = (new DateTimeImmutable())->format('Y-m-d H:i:s');

echo ' Run at ' . $now . PHP_EOL;
@file_put_contents('/mnt/job/init', 'Last init at ' . $now);

return 0;
