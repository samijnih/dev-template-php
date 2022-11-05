<?php

declare(strict_types=1);

namespace Infrastructure\SPI;

use Domain\SPI\ValidateJsonSchema;
use Swaggest\JsonSchema\Schema;

final class ValidateJsonSchemaUsingSwaggest implements ValidateJsonSchema
{
    public function __construct(private readonly Schema $schema)
    {
    }

    public function validate(array $payload, string $schema): void
    {
        $this->schema::import(json_decode($schema))
            ->in(json_decode(json_encode($payload), false));
    }
}
