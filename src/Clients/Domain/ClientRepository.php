<?php
declare(strict_types=1);

namespace App\Clients\Domain;

use App\Clients\Domain\Model\Client;
use App\Shared\Domain\ValueObject\Uuid;

interface ClientRepository
{
    public function save(Client $client): void;

    public function findByEmail(string $email): ?Client;

    public function findById(Uuid $id): ?Client;
}