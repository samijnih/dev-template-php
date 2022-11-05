<?php

declare(strict_types=1);

namespace Domain\Model\Identity;

use Ramsey\Uuid\UuidInterface;

interface Id extends \Stringable
{
    public static function fromId(UuidInterface $id): static;

    public static function fromString(string $id): static;
}
