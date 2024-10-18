<?php
declare(strict_types=1);

namespace App\Client\Application\Update;

use App\Client\Application\ClientFinder;
use App\Client\Domain\ClientRepository;
use App\Client\Domain\ValueObject\Address;
use App\Shared\Domain\ValueObject\Uuid;

readonly class ClientAddressUpdater
{
    private ClientFinder $finder;

    public function __construct(private ClientRepository $repository)
    {
        $this->finder = new ClientFinder($repository);
    }

    public function __invoke(Uuid $id, Address $address): void
    {
        $client = $this->finder->getById($id);
        $client->details()->changeAddress($address);

        $this->repository->save($client);
    }
}