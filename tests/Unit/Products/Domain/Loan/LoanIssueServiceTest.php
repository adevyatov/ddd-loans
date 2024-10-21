<?php

declare(strict_types=1);

namespace App\Tests\Unit\Products\Domain\Loan;

use App\Products\Domain\Loan\Adjustment\LoanAdjustment;
use App\Products\Domain\Loan\DTO\LoanApplication;
use App\Products\Domain\Loan\DTO\LoanClient;
use App\Products\Domain\Loan\LoanIssueService;
use App\Products\Domain\Loan\LoanRestrictionService;
use App\Products\Domain\Loan\LoanTerms;
use App\Shared\Domain\Enum\State;
use App\Shared\Domain\ValueObject\Uuid;
use PHPUnit\Framework\TestCase;

class LoanIssueServiceTest extends TestCase
{
    public function testIssueIsRestrictedShouldReturnNull(): void
    {
        $restrictionService = $this->createMock(LoanRestrictionService::class);
        $restrictionService->method('isRestrictedFor')->willReturn(true);

        $application = $this->createLoanApplication();

        $loanIssueService = new LoanIssueService($restrictionService, []);
        $loan = $loanIssueService->issue($application);

        $this->assertNull($loan);
    }

    public function testIssueIsAdjustmentShouldIncreaseRate(): void
    {
        $restrictionService = $this->createMock(LoanRestrictionService::class);
        $restrictionService->method('isRestrictedFor')->willReturn(false);

        $adjustment = $this->createMock(LoanAdjustment::class);
        $adjustment->method('adjust')->willReturn(
            new LoanTerms(
                months: 10,
                interestRate: '42',
                amount: 75000,
            )
        );

        $application = $this->createLoanApplication();

        $loanIssueService = new LoanIssueService($restrictionService, [$adjustment]);
        $loan = $loanIssueService->issue($application);

        $this->assertNotNull($loan);
        $this->assertSame($loan->terms()->interestRate, '42');
        $this->assertSame($loan->terms()->months, 10);
        $this->assertSame($loan->terms()->amount, 75000);
    }

    public function testIssueShouldReturnLoanWithRequestedTerms(): void
    {
        $restrictionService = $this->createMock(LoanRestrictionService::class);
        $restrictionService->method('isRestrictedFor')->willReturn(false);

        $application = $this->createLoanApplication();

        $loanIssueService = new LoanIssueService($restrictionService, []);
        $loan = $loanIssueService->issue($application);

        $this->assertNotNull($loan);
        $this->assertSame($loan->terms()->interestRate, $application->terms->interestRate);
        $this->assertSame($loan->terms()->months, $application->terms->months);
        $this->assertSame($loan->terms()->amount, $application->terms->amount);
    }

    private function createLoanApplication(): LoanApplication
    {
        return new LoanApplication(
            new LoanTerms(
                months: 12,
                interestRate: '6.4',
                amount: 80000,
            ),
            new LoanClient(
                id: Uuid::generate(),
                fico: 750,
                age: 32,
                state: State::Alabama,
                incomePerMonth: 4000,
            ),
        );
    }
}
