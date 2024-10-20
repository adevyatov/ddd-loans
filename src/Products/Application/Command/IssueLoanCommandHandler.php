<?php
declare(strict_types=1);

namespace App\Products\Application\Command;

use App\Products\Domain\Loan\DTO\LoanApplication;
use App\Products\Domain\Loan\LoanIssueService;
use App\Products\Domain\Loan\LoanRepository;
use App\Shared\Domain\Bus\Command\CommandHandler;

final class IssueLoanCommandHandler implements CommandHandler
{
    public function __construct(
        private readonly LoanIssueService $issueService,
        private readonly LoanRepository $loanRepository
    )
    {
    }

    public function handle(IssueLoanCommand $command): void
    {
        $loan = $this->issueService->issue(new LoanApplication($command->terms, $command->client));

        if (!$loan) {
            return;
        }

        $this->loanRepository->save($loan);
    }
}