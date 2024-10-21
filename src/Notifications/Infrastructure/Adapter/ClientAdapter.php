<?php

declare(strict_types=1);

namespace App\Notifications\Infrastructure\Adapter;

use App\Clients\Infrastructure\API\API;
use App\Notifications\Domain\Client;
use App\Shared\Domain\ValueObject\Uuid;

class ClientAdapter
{
    public function __construct(private readonly API $api)
    {
    }

    public function getClientById(Uuid $id): ?Client
    {
        $details = $this->api->getClientDetails($id->value);

        return new Client(
            email: $details['contacts']['email'],
            phone: $details['contacts']['phone'],
        );
    }
}
