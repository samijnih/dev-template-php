<?php

declare(strict_types=1);

namespace Domain\Model\Saga;

enum State: int
{
    case PROCESSING = 0;
    case FAILED = -1;
    case SUCCEEDED = 1;

    public function equalsTo(self ...$other): bool
    {
        return (bool) array_reduce(
            $other,
            static fn ($previous, $current): bool => $previous && $current,
            $this->value
        );
    }
}
