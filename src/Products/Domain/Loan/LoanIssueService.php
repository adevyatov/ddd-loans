<?php

declare(strict_types=1);

namespace App\Products\Domain\Loan;

use App\Products\Domain\Loan\Adjustment\LoanAdjustment;
use App\Products\Domain\Loan\DTO\LoanApplication;
use App\Shared\Domain\ValueObject\Uuid;

class LoanIssueService
{
    /**
     * @param iterable<int, LoanAdjustment> $adjustments
     */
    public function __construct(
        private readonly LoanRestrictionService $restrictionService,
        private readonly iterable $adjustments = []
    ) {
    }

    public function issue(LoanApplication $application): ?Loan
    {
        if ($this->restrictionService->isRestrictedFor($application->client)) {
            return null;
        }

        $terms = $application->terms;

        foreach ($this->adjustments as $adjustment) {
            $adjustedTerms = $adjustment->adjust($terms, $application->client);
            if (!$adjustedTerms) {
                continue;
            }

            $terms = $adjustedTerms;
        }

        return Loan::issue(Uuid::generate(), $application->client->id, $terms);
    }
}
