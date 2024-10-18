<?php
declare(strict_types=1);

namespace App\Client\Infrastructure\Repository;

use App\Client\Domain\ClientRepository;
use App\Client\Domain\Model\Client;
use App\Shared\Domain\ValueObject\Uuid;

class InMemoryClientRepository implements ClientRepository
{
    /** @psalm-var array<string, Client> */
    private array $clients = [];

    public function save(Client $client): void
    {
        $this->clients[$client->id()->value] = $client;
    }

    public function findByEmail(string $email): ?Client
    {
        foreach ($this->clients as $client) {
            if ($client->details()->contacts()->email() === $email) {
                return $client;
            }
        }

        return null;
    }

    public function findById(Uuid $id): ?Client
    {
        return $this->clients[$id->value];
    }
}