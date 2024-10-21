<?php

declare(strict_types=1);

namespace App\Products\Domain\Loan\Event;

use App\Shared\Domain\Bus\Event\EventHandler;
use App\Shared\Domain\ValueObject\Uuid;

final readonly class LoanIssuedHandler implements EventHandler
{
    public function __construct(
        public Uuid $clientId,
        public int $months,
        public string $interestRate,
        public int $amount,
    ) {
    }
}
