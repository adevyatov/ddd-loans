<?php
declare(strict_types=1);

namespace App\Product\Domain\Loan;

interface LoanRepository
{
    public function save(Loan $loan);
}