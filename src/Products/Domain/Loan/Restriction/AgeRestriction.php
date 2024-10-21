<?php

declare(strict_types=1);

namespace App\Products\Domain\Loan\Restriction;

use App\Products\Domain\Loan\DTO\LoanClient;

class AgeRestriction implements LoanRestriction
{
    public function isRestricted(LoanClient $client): bool
    {
        return $client->age < 18 || $client->age > 60;
    }
}
