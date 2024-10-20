<?php
declare(strict_types=1);

namespace App\Products\Domain\Loan;

interface LoanRepository
{
    public function save(Loan $loan): void;
}