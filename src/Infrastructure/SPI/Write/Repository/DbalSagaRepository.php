<?php

declare(strict_types=1);

namespace Infrastructure\SPI\Write\Repository;

use Doctrine\DBAL\Connection;
use Domain\Model\Saga\Saga;
use Domain\Model\Saga\SagaId;
use Domain\Model\Saga\SagaRepository;
use Domain\SPI\Saga\SagaSerializer;

final class DbalSagaRepository implements SagaRepository
{
    public function __construct(
        private readonly Connection $connection,
        private readonly SagaSerializer $serializer,
    ) {
    }

    public function store(Saga $saga): void
    {
        $sql = <<<'SQL'
            INSERT INTO public.saga (id, metadata, payload) VALUES (:id, :metadata, :payload)
            SQL;

        $serialized = $this->serializer->serialize($saga);

        $this->connection->executeStatement($sql, [
            'id' => $serialized['id'],
            'metadata' => $serialized['metadata'],
            'payload' => $serialized['payload'],
        ]);
    }

    public function get(SagaId $sagaId): Saga
    {
        $sql = <<<'SQL'
            SELECT * FROM public.saga WHERE id = :id
            SQL;

        $serialized = $this->connection->fetchAssociative($sql, ['id' => $sagaId->value]);

        if (false === $serialized) {
            throw new \Exception('toto');
        }

        return $this->serializer->deserialize($serialized);
    }
}
