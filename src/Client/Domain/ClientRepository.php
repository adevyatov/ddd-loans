<?php
declare(strict_types=1);

namespace App\Client\Domain;

use App\Client\Domain\Model\Client;
use App\Shared\Domain\ValueObject\Uuid;

interface ClientRepository
{
    public function save(Client $client): void;

    public function findByEmail(string $email): ?Client;

    public function findById(Uuid $id): ?Client;
}