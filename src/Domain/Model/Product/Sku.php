<?php

declare(strict_types=1);

namespace Domain\Model\Product;

final class Sku
{
    public function __construct(public readonly string $value)
    {
    }
}