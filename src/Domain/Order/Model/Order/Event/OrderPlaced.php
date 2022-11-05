<?php

declare(strict_types=1);

namespace Domain\Order\Model\Order\Event;

use Ramsey\Uuid\UuidInterface;

final class OrderPlaced
{
    public function __construct(
        public readonly UuidInterface $id,
        public readonly string $internalId,
        public readonly array $products,
    ) {
    }
}
