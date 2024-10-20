<?php
declare(strict_types=1);

namespace App\Product\Domain\Loan\Adjustments;

use App\Product\Domain\Loan\DTO\LoanClient;
use App\Product\Domain\Loan\LoanTerms;

interface LoanAdjustment
{
    public function adjust(LoanTerms $terms, LoanClient $client): ?LoanTerms;
}