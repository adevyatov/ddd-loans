<?php
declare(strict_types=1);

namespace App\Products\Domain\Loan\Adjustments;

use App\Products\Domain\Loan\DTO\LoanClient;
use App\Products\Domain\Loan\LoanTerms;
use App\Shared\Domain\Enum\State;

class InterestRateAdjustment implements LoanAdjustment
{
    public function adjust(LoanTerms $terms, LoanClient $client): ?LoanTerms
    {
        if ($client->state === State::California) {
            return new LoanTerms(
                months: $terms->months,
                interestRate: bcadd($terms->interestRate, '11.49', 2),
                amount: $terms->amount
            );
        }

        return null;
    }
}