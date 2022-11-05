<?php

declare(strict_types=1);

namespace Domain\SPI\Clock;

use Assert\Assertion;

final class ClockSerializer
{
    public function serialize(\DateTimeImmutable $dateTimeImmutable): string
    {
        return $dateTimeImmutable->format(DATE_RFC3339_EXTENDED);
    }

    public function deserialize(string $dateTimeImmutable): \DateTimeImmutable
    {
        $object = \DateTimeImmutable::createFromFormat(DATE_RFC3339_EXTENDED, $dateTimeImmutable);

        Assertion::isInstanceOf($object, \DateTimeImmutable::class);

        return $object;
    }
}
