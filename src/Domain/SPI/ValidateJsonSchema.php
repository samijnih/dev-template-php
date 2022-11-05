<?php

declare(strict_types=1);

namespace Domain\SPI;

interface ValidateJsonSchema
{
    public function validate(array $payload, string $schema): void;
}
