<?php

declare(strict_types=1);

namespace Domain\Model\Saga;

use DateTimeImmutable;
use Domain\SPI\Clock\Clock;

class Saga
{
    private readonly string $id;
    private readonly int $state;
    private readonly array $metadata;
    private readonly array $payload;
    private ?DateTimeImmutable $updatedAt;
    private ?DateTimeImmutable $finishedAt;

    public function __construct(
        SagaId $id,
        State $state,
        Metadata $metadata,
        Payload $payload,
        public readonly DateTimeImmutable $createdAt,
        ?DateTimeImmutable $updatedAt,
        ?DateTimeImmutable $finishedAt,
    ) {
        $this->id = (string) $id;
        $this->state = $state->value;
        $this->metadata = $metadata->jsonSerialize();
        $this->payload = $payload->jsonSerialize();
        $this->updatedAt = $updatedAt;
        $this->finishedAt = $finishedAt;
    }

    public static function start(
        SagaId $id,
        Metadata $metadata,
        Payload $payload,
        Clock $clock,
    ): self {
        return new self(
            $id,
            StateMachine::create()->state,
            $metadata,
            $payload,
            $clock->now(),
            null,
            null,
        );
    }

    public function updatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }
}
