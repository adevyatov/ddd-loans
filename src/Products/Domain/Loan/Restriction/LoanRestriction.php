<?php

declare(strict_types=1);

namespace App\Products\Domain\Loan\Restriction;

use App\Products\Domain\Loan\DTO\LoanClient;

interface LoanRestriction
{
    public function isRestricted(LoanClient $client): bool;
}
