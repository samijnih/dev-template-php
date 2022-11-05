<?php

declare(strict_types=1);

namespace Domain\Model\Identity;

use Ramsey\Uuid\Rfc4122\UuidV4;
use Ramsey\Uuid\UuidInterface;

abstract class Uuid implements Id
{
    public function __construct(public readonly UuidInterface $value)
    {
    }

    public function __toString(): string
    {
        return $this->value->toString();
    }

    public static function fromId(UuidInterface $id): static
    {
        return new static($id);
    }

    public static function fromString(string $id): static
    {
        return new static(UuidV4::fromString($id));
    }
}
