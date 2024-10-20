<?php
declare(strict_types=1);

namespace App\Products\Domain\Loan\DTO;

use App\Shared\Domain\Enum\State;

final readonly class LoanClient
{
    public function __construct(
        public int $creditScore,
        public int $incomePerMonth,
        public int $age,
        public State $state,
    )
    {
    }
}