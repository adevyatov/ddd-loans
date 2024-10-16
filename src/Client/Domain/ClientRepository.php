<?php
declare(strict_types=1);

namespace App\Client\Domain;

use App\Common\Domain\ValueObject\Uuid;

interface ClientRepository
{
    public function save(Client $client): void;

    public function findByEmail(string $email): ?Client;

    public function findById(Uuid $id): ?Client;
}