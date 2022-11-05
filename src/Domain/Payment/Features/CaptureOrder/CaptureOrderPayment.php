<?php

declare(strict_types=1);

namespace Domain\Payment\Features\CaptureOrder;

use Ramsey\Uuid\UuidInterface;

final class CaptureOrderPayment
{
    public function __construct(
        public readonly UuidInterface $orderId
    ) {
    }
}
