<?php
declare(strict_types=1);

namespace App\Products\Infrastructure\Adapter;

use App\Clients\Infrastructure\API\API;
use App\Products\Domain\Client;
use App\Shared\Domain\ValueObject\Uuid;

class ClientAdapter
{
    public function __construct(private readonly API $api)
    {
    }

    public function getLoanClientById(Uuid $id): ?Client
    {
        $details = $this->api->getClientDetails($id->value);

        return new Client(
            id: $id,
            fico: $details['fico'],
            age: $details['age'],
            state: $details['address']['state'],
        );
    }
}