<?php

declare(strict_types=1);

namespace Domain\Order\Model\Order;

use Money\Money;

final class ImmutablePrice
{
    public function __construct(
        private readonly Money $money,
    ) {
    }

    public function amount(): string
    {
        return $this->money->getAmount();
    }

    public function currency(): string
    {
        return $this->money->getCurrency()->getCode();
    }
}