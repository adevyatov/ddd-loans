<?php

declare(strict_types=1);

namespace App\Clients\Application\Query;

use App\Clients\Domain\Client;
use App\Clients\Domain\ClientNotFound;
use App\Clients\Domain\ClientRepository;
use App\Shared\Domain\Bus\Query\QueryHandler;

class FindClientQueryHandler implements QueryHandler
{
    public function __construct(private readonly ClientRepository $repository)
    {
    }

    public function __invoke(FindClientQuery $query): Client
    {
        if ($query->id) {
            return $this->repository->findById($query->id);
        }

        if ($query->email !== null) {
            return $this->repository->findByEmail($query->email);
        }

        throw new ClientNotFound();
    }
}
