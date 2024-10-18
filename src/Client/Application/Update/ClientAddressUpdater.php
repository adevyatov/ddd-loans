<?php
declare(strict_types=1);

namespace App\Client\Application\Update;

use App\Client\Application\ClientFinder;
use App\Client\Domain\Client;
use App\Client\Domain\ClientNotFound;
use App\Client\Domain\ClientRepository;
use App\Client\Domain\ValueObject\ClientDetails;
use App\Shared\Domain\ValueObject\Uuid;

readonly class ClientUpdater
{
    private readonly ClientFinder $finder;

    public function __construct(private ClientRepository $repository)
    {
        $this->finder = new ClientFinder($repository);
    }

    public function __invoke(Uuid $id, ClientDetails $details): ?Client
    {
        $client = $this->finder->byId($id);

        if (!$client) {
            throw new ClientNotFound();
        }

        $client->details();
    }
}