<?php

declare(strict_types=1);

namespace App\Clients\Application\Command;

use App\Clients\Domain\ClientRepository;
use App\Shared\Domain\Bus\Command\CommandHandler;

class UpdateClientDetailsCommandHandler implements CommandHandler
{
    public function __construct(private readonly ClientRepository $repository)
    {
    }

    public function __invoke(UpdateClientDetailsCommand $command): void
    {
        $client = $this->repository->findById($command->id);

        if ($command->name) {
            $client->details()->changeName($command->name);
        }

        if ($command->age !== null) {
            $client->details()->changeAge($command->age);
        }

        if ($command->contacts) {
            $client->details()->changeContacts($command->contacts);
        }

        if ($command->address) {
            $client->details()->changeAddress($command->address);
        }

        if ($command->ssn) {
            $client->details()->changeSSN($command->ssn);
        }

        if ($command->fico) {
            $client->details()->changeFICO($command->fico);
        }

        $this->repository->save($client);
    }
}
