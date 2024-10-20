<?php
declare(strict_types=1);

namespace App\Product\Domain\Loan\Restriction;

use App\Product\Domain\Loan\DTO\LoanApplication;

class AgeRestriction implements LoanRestriction
{
    public function isRestricted(LoanApplication $application): bool
    {
        return $application->age < 18 || $application->age > 60;
    }
}