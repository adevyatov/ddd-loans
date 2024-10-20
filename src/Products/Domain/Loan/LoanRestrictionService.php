<?php
declare(strict_types=1);

namespace App\Products\Domain\Loan;

use App\Products\Domain\Loan\DTO\LoanClient;
use App\Products\Domain\Loan\Restriction\LoanRestriction;

class LoanRestrictionService
{

    /**
     * @param LoanRestriction[] $restrictions
     */
    public function __construct(private readonly iterable $restrictions = [])
    {
    }

    public function isRestrictedFor(LoanClient $client): bool
    {
        foreach ($this->restrictions as $restriction) {
            if ($restriction->isRestricted($client)) {
                return true;
            }
        }

        return false;
    }
}