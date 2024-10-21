<?php

declare(strict_types=1);

namespace App\Products\Application\Query;

use App\Products\Domain\Client;
use App\Products\Domain\ClientRepository;
use App\Shared\Domain\Bus\Query\QueryHandler;

final readonly class FindClientQueryHandler implements QueryHandler
{
    public function __construct(private ClientRepository $clientRepository)
    {

    }

    public function __invoke(FindClientQuery $query): Client
    {
        return $this->clientRepository->getById($query->id);
    }
}
