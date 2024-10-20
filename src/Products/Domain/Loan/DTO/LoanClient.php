<?php
declare(strict_types=1);

namespace App\Products\Domain\Loan\DTO;

use App\Shared\Domain\Enum\State;
use App\Shared\Domain\ValueObject\Uuid;

final readonly class LoanClient
{
    public function __construct(
        public Uuid $id,
        public int $creditScore,
        public int $incomePerMonth,
        public int $age,
        public State $state,
    )
    {
    }
}