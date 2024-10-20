<?php
declare(strict_types=1);

namespace App\Product\Domain\Loan\Restriction;

use App\Product\Domain\Loan\DTO\LoanApplication;

interface LoanRestriction
{
    public function isRestricted(LoanApplication $application): bool;
}