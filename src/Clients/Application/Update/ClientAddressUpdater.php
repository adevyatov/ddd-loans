<?php
declare(strict_types=1);

namespace App\Clients\Application\Update;

use App\Clients\Application\ClientFinder;
use App\Clients\Domain\ClientNotFound;
use App\Clients\Domain\ClientRepository;
use App\Clients\Domain\Model\Client;
use App\Clients\Domain\ValueObject\ClientDetails;
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