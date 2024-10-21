<?php

declare(strict_types=1);

namespace App\Products\Infrastructure\Database\Repository;

use App\Products\Domain\Client;
use App\Products\Domain\ClientNotFound;
use App\Products\Domain\ClientRepository as DomainClientRepository;
use App\Products\Infrastructure\Adapter\ClientAdapter;
use App\Shared\Domain\ValueObject\Uuid;

class ClientRepository implements DomainClientRepository
{
    public function __construct(private readonly ClientAdapter $clientAdapter)
    {
    }

    public function getById(Uuid $id): Client
    {
        $client = $this->clientAdapter->getLoanClientById($id);

        if ($client === null) {
            throw new ClientNotFound();
        }

        return $client;
    }

}
