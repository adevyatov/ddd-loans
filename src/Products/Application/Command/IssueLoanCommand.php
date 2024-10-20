<?php
declare(strict_types=1);

namespace App\Products\Application\Command;

use App\Products\Domain\Loan\DTO\LoanClient;
use App\Products\Domain\Loan\LoanTerms;
use App\Shared\Domain\Bus\Command\Command;

final readonly class IssueLoanCommand implements Command
{

    public function __construct(public LoanClient $client, public LoanTerms $terms)
    {
    }
}