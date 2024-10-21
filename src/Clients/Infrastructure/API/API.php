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
     *       }
     *  }
     */
    public function getClientDetails(string $id): array
    {
        /** @var Client $client */
        $client = $this->queryBus->execute(new FindClientByIdQuery(new Uuid($id)));

        return [
            'age' => $client->details()->age(),
            'name' => [
                'firstName' => $client->details()->name()->firstName,
                'lastName' => $client->details()->name()->lastName,
            ],
            'fico' => $client->details()->fico()->value,
            'ssn' => $client->details()->ssn()->value,
            'contacts' => [
                'email' => $client->details()->contacts()->email,
                'phone' => $client->details()->contacts()->phone,
            ]
        ];
    }
}