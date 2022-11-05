<?php

declare(strict_types=1);

namespace Domain\Model\Saga;

use Assert\Assertion;

final class StateMachine
{
    public function __construct(public readonly State $state)
    {
    }

    public static function create(): self
    {
        return new self(State::PROCESSING);
    }

    public function fail(): self
    {
        Assertion::true($this->state->equalsTo(State::PROCESSING), 'Incorrect state.');

        return new self(State::FAILED);
    }

    public function succeed(): self
    {
        Assertion::true($this->state->equalsTo(State::PROCESSING, State::FAILED), 'Incorrect state.');

        return new self(State::SUCCEEDED);
    }
}
