<?php

declare(strict_types=1);

namespace Domain\Model\Product;

use Assert\Assertion;

final class Quantity
{
    public function __construct(public readonly int $value)
    {
        Assertion::greaterThan(0, 'Quantity should be greater than 0.');
    }
}