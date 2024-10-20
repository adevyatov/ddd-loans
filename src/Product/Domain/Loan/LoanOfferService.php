<?php
declare(strict_types=1);

namespace App\Product\Domain\Loan;

use App\Product\Domain\Loan\Adjustments\LoanAdjustment;
use App\Product\Domain\Loan\DTO\LoanApplication;
use App\Product\Domain\Loan\Restriction\LoanRestriction;

class LoanOfferService
{
    /**
     * @param LoanRestriction[] $restrictions
     * @param LoanAdjustment[] $adjustments
     */
    public function __construct(private readonly array $restrictions, private readonly array $adjustments)
    {
    }

    public function getOffer(LoanApplication $application): ?Loan
    {
        foreach ($this->restrictions as $restriction) {
            if ($restriction->isRestricted($application)) {
                return null;
            }
        }

        $terms = $application->terms;

        foreach ($this->adjustments as $adjustment) {
            $adjustedTerms = $adjustment->adjust($terms, $application->client);
            if (!$adjustedTerms) {
                continue;
            }

            $terms = $adjustedTerms;
        }

        return new Loan($terms);
    }
}