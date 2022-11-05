<?php

declare(strict_types=1);

namespace Domain\Order\Model\Order;

use Assert\Assertion;

final class Products
{
    public function __construct(public readonly array $products)
    {
        Assertion::allIsInstanceOf($products, Product::class);
    }

    public function toArray(): array
    {
        return $this->products;
    }
}