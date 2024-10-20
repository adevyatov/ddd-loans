<?php
declare(strict_types=1);

namespace App\Products\Domain\Loan;

use App\Products\Domain\Loan\Adjustments\LoanAdjustment;
use App\Products\Domain\Loan\DTO\LoanApplication;
use App\Shared\Domain\ValueObject\Uuid;

class LoanIssueService
{
    /**
     * @param LoanAdjustment[] $adjustments
     */
    public function __construct(
        private readonly LoanRestrictionService $restrictionService,
        private readonly array $adjustments
    )
    {
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

        return new Loan(Uuid::generate(), $terms);
    }
}