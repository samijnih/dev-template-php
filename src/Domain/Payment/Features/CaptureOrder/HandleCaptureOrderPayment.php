<?php

declare(strict_types=1);

namespace Domain\Payment\Features\CaptureOrder;

use Domain\Payment\Model\Payment\Event\OrderPaymentCaptured;
use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

#[AsMessageHandler(bus: 'command.bus', fromTransport: 'capture_payment')]
final class HandleCaptureOrderPayment
{
    public function __construct(private readonly MessageBusInterface $eventBus)
    {
    }

    public function __invoke(CaptureOrderPayment $captureOrderPayment): void
    {
        $this->eventBus->dispatch(
            new OrderPaymentCaptured(
                $captureOrderPayment->orderId,
            ),
            [new DispatchAfterCurrentBusStamp()],
        );
    }
}
