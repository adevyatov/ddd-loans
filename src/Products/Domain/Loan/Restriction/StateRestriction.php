<?php
declare(strict_types=1);

namespace App\Products\Domain\Loan\Restriction;

use App\Products\Domain\Loan\DTO\LoanApplication;
use App\Shared\Domain\Enum\State;

class StateRestriction implements LoanRestriction
{
    public function isRestricted(LoanApplication $application): bool
    {
        return !in_array($application->state, $this->getAllowedStates(), true);
    }

    /**
     * @return State[]
     */
    private function getAllowedStates(): iterable
    {
        return [State::California, State::NewYork, State::Nevada];
    }
}