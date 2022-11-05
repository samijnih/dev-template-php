<?php

declare(strict_types=1);

namespace Domain\API;

interface CommandBus
{
    public function send(object $command): void;
}