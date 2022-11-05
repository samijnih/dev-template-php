<?php

declare(strict_types=1);

namespace Tests\Stub;

use Domain\SPI\Clock\Clock;

final class StubbedClock implements Clock
{
    public const STUBBED = '2022-01-01T00:00:00.000+00:00';

    public function now(\DateTimeZone $timeZone = new \DateTimeZone('UTC')): \DateTimeImmutable
    {
        return new \DateTimeImmutable(self::STUBBED);
    }
}
