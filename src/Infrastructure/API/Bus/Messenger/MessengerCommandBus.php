<?php

declare(strict_types=1);

namespace Infrastructure\API\Bus\Messenger;

use Domain\API\CommandBus;
use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;

final class MessengerCommandBus implements CommandBus
{
    public function __construct(
        private readonly MessageBusInterface $commandBus,
    ) {
    }

    public function send(object $command): void
    {
        $this->commandBus->dispatch($command, [
            new DispatchAfterCurrentBusStamp(),
        ]);
    }
}