<?php
declare(strict_types=1);

namespace App\Products\Domain\Loan\Restriction;

use App\Products\Domain\Loan\DTO\LoanApplication;

interface LoanRestriction
{
    public function isRestricted(LoanApplication $application): bool;
}