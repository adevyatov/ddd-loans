<?php

declare(strict_types=1);

namespace App\Products\Domain\Loan\Adjustment;

use App\Products\Domain\Loan\DTO\LoanClient;
use App\Products\Domain\Loan\LoanTerms;

interface LoanAdjustment
{
    public function adjust(LoanTerms $terms, LoanClient $client): ?LoanTerms;
}
