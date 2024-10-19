<?php
declare(strict_types=1);

namespace App\Clients\Application\Update;

use App\Clients\Application\ClientFinder;
use App\Clients\Domain\ClientRepository;
use App\Clients\Domain\ValueObject\Contacts;
use App\Shared\Domain\ValueObject\Uuid;

readonly class ClientContactsUpdater
{
    private ClientFinder $finder;

    public function __construct(private ClientRepository $repository)
    {
        $this->finder = new ClientFinder($repository);
    }

    public function __invoke(Uuid $id, Contacts $contacts): void
    {
        $client = $this->finder->getById($id);
        $client->details()->changeContacts($contacts);

        $this->repository->save($client);
    }
}