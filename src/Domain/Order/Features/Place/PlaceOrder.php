<?php

declare(strict_types=1);

namespace Domain\Order\Features\Place;

final class PlaceOrder
{
    public function __construct(
        public readonly string $internalId,
        public readonly array $products,
    ) {
    }

    public static function create(
        string $internalId,
        array $products,
    ): self {
        return new self(
            $internalId,
            $products
        );
    }

    public function toJson(): string
    {
        return json_encode($this);
    }
}
