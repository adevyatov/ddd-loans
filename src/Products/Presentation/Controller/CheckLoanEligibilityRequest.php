<?php

declare(strict_types=1);

namespace App\Products\Presentation\Controller;

use Symfony\Component\Validator\Constraints\GreaterThan;
use Symfony\Component\Validator\Constraints\Uuid;

final readonly class CheckLoanEligibilityRequest
{
    public function __construct(
        #[Uuid]
        public string $clientId,
        #[GreaterThan(0)]
        public int $incomePerMonth
    ) {
    }
}
