<?php

declare(strict_types=1);

namespace App\Products\Domain\Loan\Restriction;

use App\Products\Domain\Loan\DTO\LoanClient;
use App\Products\Domain\Loan\Randomizer;
use App\Shared\Domain\Enum\State;

class StateRestriction implements LoanRestriction
{
    public function __construct(private readonly Randomizer $randomizer)
    {
    }

    public function isRestricted(LoanClient $client): bool
    {
        if (!in_array($client->state, $this->getAllowedStates(), true)) {
            return true;
        }

        if ($client->state === State::NewYork) {
            return $this->shouldRejectClientFromNY();
        }

        return false;
    }

    /**
     * @return State[]
     */
    private function getAllowedStates(): iterable
    {
        return [State::California, State::NewYork, State::Nevada];
    }

    private function shouldRejectClientFromNY(): bool
    {
        return $this->randomizer->random(1, 100) <= 30;
    }
}
