<?php

declare(strict_types=1);

namespace App\Products\Application\Query;

use App\Products\Domain\Loan\LoanRestrictionService;
use App\Shared\Domain\Bus\Query\QueryHandler;

class CheckLoanEligibilityQueryHandler implements QueryHandler
{
    public function __construct(private readonly LoanRestrictionService $restrictionService)
    {
    }

    public function __invoke(CheckLoanEligibilityQuery $query): bool
    {
        return $this->restrictionService->isRestrictedFor($query->client);
    }
}
