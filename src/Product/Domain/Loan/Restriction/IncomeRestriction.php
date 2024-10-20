<?php
declare(strict_types=1);

namespace App\Product\Domain\Loan\Restriction;

use App\Product\Domain\Loan\DTO\LoanApplication;

class IncomeRestriction implements LoanRestriction
{
    public function isRestricted(LoanApplication $application): bool
    {
        return $application->incomePerMonth < 1000;
    }
}