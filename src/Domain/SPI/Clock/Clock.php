<?php

declare(strict_types=1);

namespace Domain\SPI\Clock;

interface Clock
{
    public function now(\DateTimeZone $timeZone = new \DateTimeZone('UTC')): \DateTimeImmutable;
}
