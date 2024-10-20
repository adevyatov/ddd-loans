<?php
declare(strict_types=1);

namespace App\Clients\Application\Command;

use App\Clients\Domain\Client;
use App\Clients\Domain\ClientRepository;
use App\Shared\Domain\Bus\Command\CommandHandler;

class RegisterClientCommandHandler implements CommandHandler
{
    public function __construct(private readonly ClientRepository $repository)
    {
    }

    public function __invoke(RegisterClientCommand $command): void
    {
        $client = new Client($command->id, $command->details);

        $this->repository->save($client);
    }
}