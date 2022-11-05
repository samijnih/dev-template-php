<?php

declare(strict_types=1);

namespace Domain\Order;

use Domain\API\CommandBus;
use Domain\Model\Saga\SagaRepository;
use Domain\Order\Features\Place\PlaceOrder;
use Domain\Order\Saga\PlaceOrderSaga;
use Domain\SPI\EventBus;
use Psr\Log\LoggerInterface;
use Ramsey\Uuid\UuidFactoryInterface;

final class OrderContext
{
    public function __construct(
        private readonly CommandBus $commandBus,
        private readonly EventBus $eventBus,
        private readonly UuidFactoryInterface $uuidFactory,
        private readonly SagaRepository $sagaRepository,
        private readonly LoggerInterface $logger,
    ) {
    }

    public function place(
        string $internalId,
        array $products,
    ): void
    {
        $this->commandBus->send(
            PlaceOrder::create(
                $internalId,
                $products,
            ),
        );
    }
}
