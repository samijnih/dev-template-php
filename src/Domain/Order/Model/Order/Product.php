<?php

declare(strict_types=1);

namespace Domain\Order\Model\Order;

use Domain\Model\Product\Quantity;
use Domain\Model\Product\Sku;
use Ramsey\Uuid\UuidInterface;

class Product
{
    public readonly string $id;
    public readonly string $sku;
    public readonly int $quantity;
    public readonly string $amount;
    public readonly string $currency;

    public function __construct(
        private readonly Order $order,
        UuidInterface $id,
        Sku $sku,
        Quantity $quantity,
        ImmutablePrice $price,
    ) {
        $this->id = $id->toString();
        $this->sku = $sku->value;
        $this->quantity = $quantity->value;
        $this->amount = $price->amount();
        $this->currency = $price->currency();
    }
}