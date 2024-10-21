<?php
declare(strict_types=1);

namespace App\Notifications\Infrastructure\Repository;

use App\Notifications\Domain\Client;
use App\Notifications\Domain\ClientNotFound;
use App\Notifications\Domain\ClientRepository as DomainClientRepository;
use App\Notifications\Infrastructure\Adapter\ClientAdapter;
use App\Shared\Domain\ValueObject\Uuid;

class ClientRepository implements DomainClientRepository
{
    public function __construct(private readonly ClientAdapter $clientAdapter)
    {

    }

    public function getById(Uuid $id): Client
    {
        $client = $this->clientAdapter->getClientById($id);

        if (!$client) {
            throw new ClientNotFound();
        }

        return $client;
    }
}