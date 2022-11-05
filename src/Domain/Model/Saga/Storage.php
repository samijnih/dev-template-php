<?php

declare(strict_types=1);

namespace Domain\Model\Saga;

use JsonSerializable;

abstract class Storage implements JsonSerializable
{
    public function __construct(
        public readonly array $data,
    ) {
    }

    public static function fromArray(array $data): static
    {
        return new static($data);
    }

    public function add(array $data): static
    {
        return new static(array_merge_recursive($this->data, $data));
    }

    public function toArray(): array
    {
        return $this->data;
    }

    public function jsonSerialize(): array
    {
        return $this->toArray();
    }
}
