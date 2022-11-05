<?php

declare(strict_types=1);

namespace Tests\Unit\SPI\Saga;

use Domain\Model\Saga\Metadata;
use Domain\Model\Saga\Payload;
use Domain\Model\Saga\Saga;
use Domain\Model\Saga\SagaId;
use Domain\Model\Saga\State;
use Domain\SPI\Clock\ClockSerializer;
use Domain\SPI\Saga\SagaSerializer;
use Domain\SPI\ValidateJsonSchema;
use PHPUnit\Framework\TestCase;
use Tests\Stub\StubbedClock;

class StubbedSaga extends Saga
{
}

class DummyJsonSchemaValidator implements ValidateJsonSchema
{
    public function validate(array $payload, string $schema): void
    {
    }
}

/**
 * @internal
 */
final class SagaSerializerTest extends TestCase
{
    private StubbedClock $stubbedClock;
    private SagaSerializer $sut;

    protected function setUp(): void
    {
        $this->stubbedClock = new StubbedClock();
        $this->sut = new SagaSerializer(
            new DummyJsonSchemaValidator(),
            new ClockSerializer(),
        );
    }

    /** @test */
    public function itSerializesASaga(): void
    {
        $saga = new StubbedSaga(
            SagaId::fromString('4705933e-4d9f-454e-a82e-29f8132f97f5'),
            State::PROCESSING,
            new Metadata([
                'meta' => 'data',
            ]),
            new Payload([
                'attribute' => 'value',
            ]),
            $this->stubbedClock->now(),
            $this->stubbedClock->now(),
            $this->stubbedClock->now(),
        );
        $actual = $this->sut->serialize($saga);

        $expected = [
            'id' => '4705933e-4d9f-454e-a82e-29f8132f97f5',
            'type' => StubbedSaga::class,
            'status' => State::PROCESSING->value,
            'metadata' => [
                'meta' => 'data',
            ],
            'payload' => [
                'attribute' => 'value',
            ],
            'created_at' => $this->stubbedClock::STUBBED,
            'updated_at' => $this->stubbedClock::STUBBED,
            'finished_at' => $this->stubbedClock::STUBBED,
        ];
        self::assertSame($expected, $actual);
    }

    /** @test */
    public function itDeserializesASaga(): void
    {
        $saga = [
            'id' => '4705933e-4d9f-454e-a82e-29f8132f97f5',
            'type' => StubbedSaga::class,
            'status' => State::PROCESSING->value,
            'metadata' => [
                'meta' => 'data',
            ],
            'payload' => [
                'attribute' => 'value',
            ],
            'created_at' => $this->stubbedClock::STUBBED,
            'updated_at' => $this->stubbedClock::STUBBED,
            'finished_at' => $this->stubbedClock::STUBBED,
        ];
        $actual = $this->sut->deserialize($saga);

        $expected = new StubbedSaga(
            SagaId::fromString('4705933e-4d9f-454e-a82e-29f8132f97f5'),
            State::PROCESSING,
            new Metadata([
                'meta' => 'data',
            ]),
            new Payload([
                'attribute' => 'value',
            ]),
            $this->stubbedClock->now(),
            $this->stubbedClock->now(),
            $this->stubbedClock->now(),
        );
        self::assertEquals($expected, $actual);
    }
}
