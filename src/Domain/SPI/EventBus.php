<?php

declare(strict_types=1);

namespace Domain\SPI;

interface EventBus
{
    public function dispatch(object $event): void;
}