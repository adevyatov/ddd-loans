<?php
declare(strict_types=1);

namespace App\Products\Domain\Loan\Restriction;

use App\Products\Domain\Loan\DTO\LoanClient;

class CreditScoreRestriction implements LoanRestriction
{
    public function isRestricted(LoanClient $client): bool
    {
        return $client->creditScore < 500;
    }
}