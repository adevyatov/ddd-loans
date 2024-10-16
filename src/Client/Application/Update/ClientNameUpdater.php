<?php
declare(strict_types=1);

namespace App\Client\Application\Update;

use App\Client\Application\ClientFinder;
use App\Client\Domain\ClientRepository;
use App\Client\Domain\ValueObject\Contacts;
use App\Common\Domain\ValueObject\Uuid;

readonly class ClientSSNUpdater
{
    private ClientFinder $finder;

    public function __construct(private ClientRepository $repository)
    {
        $this->finder = new ClientFinder($repository);
    }

    public function __invoke(Uuid $id, Contacts $contacts): void
    {
        $client = $this->finder->getById($id);
        $client->details()->changeSSN($contacts);

        $this->repository->save($client);
    }
}