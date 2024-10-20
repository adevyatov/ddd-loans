<?php
declare(strict_types=1);

namespace App\Product\Domain\Loan\Adjustments;

use App\Product\Domain\Loan\DTO\LoanClient;
use App\Product\Domain\Loan\LoanTerms;
use App\Shared\Domain\Enum\State;

class InterestRateAdjustment implements LoanAdjustment
{
    public function adjust(LoanTerms $terms, LoanClient $client): ?LoanTerms
    {
        if ($client->state !== State::California) {
            return null;
        }

        return new LoanTerms(
            months: $terms->months,
            interestRate: $terms->interestRate,
            amount: $terms->amount
        );
    }
}