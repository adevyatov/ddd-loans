<?php
declare(strict_types=1);

namespace App\Client\Domain;

use App\Client\Domain\ValueObject\ClientDetails;

class ClientService
{
    public function __construct(private readonly ClientRepository $repository)
    {
    }

    public function register(ClientDetails $clientDetails): Client
    {
        $client = Client::create($clientDetails);

        $this->repository->save($client);

        return $client;
    }
}