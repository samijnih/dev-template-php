<?php

declare(strict_types=1);

namespace Domain\SPI\Saga;

use Assert\Assertion;
use Domain\Model\Saga\Metadata;
use Domain\Model\Saga\Payload;
use Domain\Model\Saga\Saga;
use Domain\Model\Saga\SagaId;
use Domain\Model\Saga\State;
use Domain\SPI\Clock\ClockSerializer;
use Domain\SPI\ValidateJsonSchema;

final class SagaSerializer
{
    public function __construct(
        private readonly ValidateJsonSchema $validateJsonSchema,
        private readonly ClockSerializer $clockSerializer,
    ) {
    }

    /**
     * @return array{id: string, type: string, status: string, metadata: array{array-key, mixed}, payload: array{array-key, mixed}, created_at: string, updated_at: ?string, finished_at: ?string}
     */
    public function serialize(Saga $saga): array
    {
        return [
            'id' => $saga->id->value->toString(),
            'type' => $saga::class,
            'status' => $saga->status->value,
            'metadata' => $saga->metadata->jsonSerialize(),
            'payload' => $saga->payload->jsonSerialize(),
            'created_at' => $this->clockSerializer->serialize($saga->createdAt),
            'updated_at' => $saga->updatedAt() ? $this->clockSerializer->serialize($saga->updatedAt()) : null,
            'finished_at' => $saga->finishedAt ? $this->clockSerializer->serialize($saga->finishedAt) : null,
        ];
    }

    /**
     * @param array{id: string, type: string, status: string, metadata: array{array-key, mixed}, payload: array{array-key, mixed}, created_at: string, updated_at: ?string, finished_at: ?string} $saga
     */
    public function deserialize(array $saga): Saga
    {
        $this->validateJsonSchema->validate($saga, file_get_contents(__DIR__.'/schema.json'));

        /** @var class-string<Saga> $sagaClass */
        $sagaClass = $saga['type'];

        Assertion::classExists($sagaClass);

        return new $sagaClass(
            SagaId::fromString($saga['id']),
            State::from($saga['status']),
            Metadata::fromArray($saga['metadata']),
            Payload::fromArray($saga['payload']),
            $this->clockSerializer->deserialize($saga['created_at']),
            $saga['updated_at'] ? $this->clockSerializer->deserialize($saga['updated_at']) : null,
            $saga['finished_at'] ? $this->clockSerializer->deserialize($saga['finished_at']) : null,
        );
    }
}
