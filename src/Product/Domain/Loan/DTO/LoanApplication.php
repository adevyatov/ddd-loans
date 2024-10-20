<?php
declare(strict_types=1);

namespace App\Product\Domain\Loan\DTO;

use App\Product\Domain\Loan\LoanTerms;

final readonly class LoanApplication
{
    public function __construct(public LoanTerms $terms, public LoanClient $client)
    {
    }
}