<?php
declare(strict_types=1);

namespace App\Client\Application;

use App\Client\Domain\ClientRepository;
use App\Client\Domain\Model\Client;
use App\Client\Domain\ValueObject\ClientDetails;

readonly class ClientCreator
{
    public function __construct(private ClientRepository $repository)
    {
    }

    public function __invoke(ClientDetails $clientDetails): Client
    {
        $client = Client::create($clientDetails);

        $this->repository->save($client);

        return $client;
    }
}