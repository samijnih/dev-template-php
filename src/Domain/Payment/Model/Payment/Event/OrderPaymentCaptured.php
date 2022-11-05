<?php

declare(strict_types=1);

namespace Domain\Payment\Model\Payment\Event;

use Ramsey\Uuid\UuidInterface;

final class OrderPaymentCaptured
{
    public function __construct(
        public readonly UuidInterface $orderId,
    ) {
    }
}
