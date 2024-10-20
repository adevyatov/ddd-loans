<?php
declare(strict_types=1);

namespace App\Products\Domain\Loan\Restriction;

use App\Products\Domain\Loan\DTO\LoanApplication;

class CreditScoreRestriction implements LoanRestriction
{
    public function isRestricted(LoanApplication $application): bool
    {
        return $application->creditScore < 500;
    }
}