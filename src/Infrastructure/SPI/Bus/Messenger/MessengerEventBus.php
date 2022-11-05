<?php

declare(strict_types=1);

namespace Infrastructure\SPI\Bus\Messenger;

use Domain\SPI\EventBus;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class MessengerEventBus implements EventBus
{
    public function __construct(private readonly MessageBusInterface $eventBus)
    {
    }

    public function dispatch(object $event): void
    {
        $this->eventBus->dispatch($event, [
            new DispatchAfterCurrentBusStamp(),
        ]);
    }
}