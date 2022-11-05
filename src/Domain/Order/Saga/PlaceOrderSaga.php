<?php

declare(strict_types=1);

namespace Domain\Order\Saga;

use Domain\API\CommandBus;
use Domain\Model\Saga\Saga;
use Domain\Order\Features\Place\PlaceOrder;
use Domain\Order\Model\Order\Event\OrderPlaced;
use Domain\Payment\Features\CaptureOrder\CaptureOrderPayment;
use Domain\Payment\Model\Payment\Event\OrderPaymentCaptured;
use Domain\SPI\EventBus;
use Psr\Log\LoggerInterface;
use Ramsey\Uuid\UuidFactoryInterface;
use Symfony\Component\Messenger\Handler\MessageSubscriberInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class PlaceOrderSaga extends Saga implements MessageSubscriberInterface
{
    public function handle(PlaceOrder $placeOrder): void
    {
        $orderId = $this->uuidFactory->uuid4();

        $this->logger->info("Placing order $orderId");

        $this->eventBus->dispatch(
            new OrderPlaced(
                $orderId,
                $placeOrder->internalId,
                $placeOrder->products,
            ),
        );
    }

    public function handleOrderPlaced(OrderPlaced $orderPlaced): void
    {
        $this->logger->info("Capturing the placed order $orderPlaced->id");

        $this->commandBus->send(
            new CaptureOrderPayment(
                $orderPlaced->id,
            ),
        );
    }

    public function handleOrderPaymentCaptured(OrderPaymentCaptured $orderPaymentCaptured): void
    {
        $this->logger->info("Payment of order $orderPaymentCaptured->orderId captured.");
    }

    public static function getHandledMessages(): iterable
    {
        yield PlaceOrder::class => [
            'bus' => 'command.bus',
        ];

        yield OrderPlaced::class => [
            'method' => 'handleOrderPlaced',
            'bus' => 'event.bus',
        ];

        yield OrderPaymentCaptured::class => [
            'method' => 'handleOrderPaymentCaptured',
            'bus' => 'event.bus',
        ];
    }
}
