<?php

declare(strict_types=1);

namespace App\Products\Presentation\Rest\Loan;

use App\Products\Application\Query\CheckLoanEligibilityQuery;
use App\Products\Application\Query\FindClientQuery;
use App\Products\Domain\Client;
use App\Products\Domain\Loan\DTO\LoanClient;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\ValueObject\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpKernel\Attribute\AsController;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Routing\Annotation\Route;

#[AsController]
class CheckLoanEligibilityAction
{
    public function __construct(private readonly QueryBus $queryBus)
    {
    }

    #[Route('/check-eligibility')]
    public function __invoke(#[MapRequestPayload] CheckLoanEligibilityRequest $request): JsonResponse
    {
        /** @var Client $client */
        $client = $this->queryBus->execute(new FindClientQuery(new Uuid($request->clientId)));
        $loanClient = LoanClient::fromClient($client, $request->incomePerMonth);

        /** @var boolean $result */
        $result = $this->queryBus->execute(new CheckLoanEligibilityQuery($loanClient));

        return new JsonResponse($result);
    }
}
