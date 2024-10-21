<?php

declare(strict_types=1);

namespace App\Clients\Infrastructure\API;

use App\Clients\Application\Query\FindClientByIdQuery;
use App\Clients\Domain\Client;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\ValueObject\Uuid;

readonly class API
{
    public function __construct(private QueryBus $queryBus)
    {
    }

    /**
     * @param string $id
     * @return array
     * @psalm-return array{
     *       age: int,
     *       name: array{
     *           firstName: string,
     *           lastName: string,
     *       },
     *       fico: int,
     *       ssn: string,
     *       contacts: array{
     *           email: string,
     *           phone: string,
     *       },
     *       address: array{
     *           city: string,
     *           state: string,
     *           zip: string,
     *       }
     *  }
     */
    public function getClientDetails(string $id): array
    {
        /** @var Client $client */
        $client = $this->queryBus->execute(new FindClientByIdQuery(new Uuid($id)));
        $details = $client->details();

        return [
            'age' => $details->age(),
            'name' => [
                'firstName' => $details->name()->firstName,
                'lastName' => $details->name()->lastName,
            ],
            'fico' => $details->fico()->value,
            'ssn' => $details->ssn()->value,
            'contacts' => [
                'email' => $details->contacts()->email,
                'phone' => $details->contacts()->phone,
            ],
            'address' => [
                'city' => $details->address()->city,
                'state' => $details->address()->state,
                'zip' => $details->address()->zip,
            ]
        ];
    }
}
