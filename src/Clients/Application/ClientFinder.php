<?php
declare(strict_types=1);

namespace App\Clients\Application;

use App\Clients\Domain\ClientRepository;
use App\Clients\Domain\Model\Client;
use App\Clients\Domain\ValueObject\ClientDetails;

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