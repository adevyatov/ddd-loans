<?php
declare(strict_types=1);

namespace App\Notifications\Domain;

use App\Shared\Domain\ValueObject\Uuid;

interface ClientRepository
{
    public function getById(Uuid $id): Client;
}