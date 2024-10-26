<?php

declare(strict_types=1);

namespace App\Products\Presentation\Controller;

use Webmozart\Assert\Assert;

final readonly class CheckLoanEligibilityRequest
{
    public function __construct(public string $clientId, public int $incomePerMonth)
    {
        $this->validate();
    }

    private function validate(): void
    {
        Assert::uuid($this->clientId, 'Client ID should be a valid UUID.');
        Assert::greaterThan($this->incomePerMonth, 0, 'Income per month is required.');
    }
}
