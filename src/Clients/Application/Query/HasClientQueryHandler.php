<?php

declare(strict_types=1);

namespace App\Clients\Application\Query;

use App\Clients\Domain\ClientRepository;
use App\Shared\Domain\Bus\Query\QueryHandler;

class HasClientQueryHandler implements QueryHandler
{
    public function __construct(private readonly ClientRepository $repository)
    {
    }

    public function __invoke(HasClientQuery $query): bool
    {
        return $this->repository->hasWithEmail($query->email);
    }
}
