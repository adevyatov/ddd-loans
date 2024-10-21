<?php

declare(strict_types=1);

namespace App\Clients\Application\Query;

use App\Clients\Domain\Client;
use App\Clients\Domain\ClientRepository;
use App\Shared\Domain\Bus\Query\QueryHandler;

class FindClientByIdQueryHandler implements QueryHandler
{
    public function __construct(private readonly ClientRepository $repository)
    {
    }

    public function __invoke(FindClientByIdQuery $query): ?Client
    {
        return $this->repository->findById($query->id);
    }
}
