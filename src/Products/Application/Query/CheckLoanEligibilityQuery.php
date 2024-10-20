<?php
declare(strict_types=1);

namespace App\Products\Application\Query;

use App\Products\Domain\Loan\DTO\LoanClient;
use App\Shared\Domain\Bus\Query\Query;

final readonly class CheckLoanEligibilityQuery implements Query
{
    public function __construct(public LoanClient $client)
    {
    }
}