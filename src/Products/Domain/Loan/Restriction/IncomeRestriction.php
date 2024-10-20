<?php
declare(strict_types=1);

namespace App\Products\Domain\Loan\Restriction;

use App\Products\Domain\Loan\DTO\LoanApplication;

class IncomeRestriction implements LoanRestriction
{
    public function isRestricted(LoanApplication $application): bool
    {
        return $application->incomePerMonth < 1000;
    }
}