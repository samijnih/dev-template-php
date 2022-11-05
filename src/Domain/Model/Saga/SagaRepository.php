<?php

declare(strict_types=1);

namespace Domain\Model\Saga;

interface SagaRepository
{
    public function store(Saga $saga): void;

    public function get(SagaId $sagaId): Saga;
}
