#!/usr/bin/env php
<?php

declare(strict_types=1);

namespace Teknoo\Space\Demo\Job;

use DateTimeImmutable;

$now = (new DateTimeImmutable())->format('Y-m-d H:i:s');

@file_put_contents('/mnt/job/output', 'Last cron execution at ' . $now);

return 0;
