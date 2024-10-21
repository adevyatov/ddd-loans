<?php

declare(strict_types=1);

namespace App\Products\Domain\Loan\DTO;

use App\Products\Domain\Loan\LoanTerms;

final readonly class LoanApplication
{
    public function __construct(public LoanTerms $terms, public LoanClient $client)
    {
    }
}
