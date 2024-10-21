<?php

declare(strict_types=1);

namespace App\Products\Application\Controller;

use App\Products\Application\Query\CheckLoanEligibilityQuery;
use App\Products\Domain\ClientRepository;
use App\Products\Domain\Loan\DTO\LoanClient;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\ValueObject\Uuid;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckLoanEligibilityAction
{
    public function __construct(private readonly QueryBus $queryBus, private readonly ClientRepository $repository)
    {
    }

    public function __invoke(Request $request): JsonResponse
    {
        $id = $request->get('id');
        $incomePerMonth = $request->get('incomePerMonth');

        if (!$id || !$incomePerMonth) {
            return new JsonResponse(null, Response::HTTP_BAD_REQUEST);
        }

        $client = $this->repository->getById(new Uuid($id));
        $loanClient = LoanClient::fromClient($client, (int)$incomePerMonth);

        /** @var boolean $result */
        $result = $this->queryBus->execute(new CheckLoanEligibilityQuery($loanClient));

        return new JsonResponse($result);
    }
}
