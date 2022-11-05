<?php

declare(strict_types=1);

namespace Tests\Unit\SPI\Clock;

use Domain\SPI\Clock\ClockSerializer;
use PHPUnit\Framework\TestCase;

/**
 * @internal
 */
final class ClockSerializerTest extends TestCase
{
    private ClockSerializer $sut;

    protected function setUp(): void
    {
        $this->sut = new ClockSerializer();
    }

    /** @test */
    public function itSerializesADateTime(): void
    {
        $actual = $this->sut->serialize(new \DateTimeImmutable('2022-01-01 12:01:02.223333+01:00'));

        self::assertSame('2022-01-01T12:01:02.223+01:00', $actual);
    }

    /** @test */
    public function itDeserializesAStringDateTime(): void
    {
        $actual = $this->sut->deserialize('2022-01-01T12:01:02.223+01:00');

        self::assertEquals(new \DateTimeImmutable('2022-01-01 12:01:02.223000+01:00'), $actual);
    }
}
