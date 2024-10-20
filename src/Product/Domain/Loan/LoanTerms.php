<?php
declare(strict_types=1);

namespace App\Product\Domain\Loan;

use Webmozart\Assert\Assert;

final readonly class LoanTerms
{
    public function __construct(
        public int $months,
        public float $interestRate,
        public int $amount,
    )
    {
        $this->validate();
    }

    public function validate(): void
    {
        Assert::greaterThan($this->months, 0, 'Loan months must be greater than 0');
        Assert::greaterThan($this->interestRate, 0, 'Interest rate must be greater than 0');
        Assert::greaterThan($this->amount, 0, 'Amount must be greater than 0');
    }
}