<?php
declare(strict_types=1);

namespace App\Clients\Domain;

use App\Clients\Domain\Model\Client;
use App\Clients\Domain\ValueObject\ClientDetails;

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