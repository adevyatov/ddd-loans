<?php

declare(strict_types=1);

namespace App\Products\Domain\Loan\DTO;

use App\Products\Domain\Client;
use App\Shared\Domain\Enum\State;
use App\Shared\Domain\ValueObject\Uuid;

final readonly class LoanClient extends Client
{
    public function __construct(
        Uuid $id,
        int $fico,
        int $age,
        State $state,
        public int $incomePerMonth,
    ) {
        parent::__construct($id, $fico, $age, $state);
    }
}
