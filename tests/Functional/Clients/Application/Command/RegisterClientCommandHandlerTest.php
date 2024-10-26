<?php

declare(strict_types=1);

namespace App\Tests\Functional\Clients\Application\Command;

use App\Clients\Application\Command\RegisterClientCommand;
use App\Clients\Application\Query\FindClientQuery;
use App\Clients\Domain\Client;
use App\Clients\Domain\ValueObject\Address;
use App\Clients\Domain\ValueObject\ClientDetails;
use App\Clients\Domain\ValueObject\Contacts;
use App\Clients\Domain\ValueObject\FICO;
use App\Clients\Domain\ValueObject\Name;
use App\Clients\Domain\ValueObject\SSN;
use App\Shared\Domain\Bus\Command\CommandBus;
use App\Shared\Domain\Bus\Query\QueryBus;
use App\Shared\Domain\ValueObject\Uuid;
use DataFixtures\ClientFixture;
use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class RegisterClientCommandHandlerTest extends WebTestCase
{
    public function testClientShouldAbleRegister(): void
    {
        /** @var CommandBus $commandBus */
        $commandBus = static::getContainer()->get(CommandBus::class);
        /** @var QueryBus $queryBus */
        $queryBus = static::getContainer()->get(QueryBus::class);

        $id = Uuid::generate();
        $commandBus->execute(new RegisterClientCommand($id, $this->createClientDetails()));

        /** @var Client|null $client */
        $client = $queryBus->execute(new FindClientQuery($id));

        $this->assertNotEmpty($client);
        $this->assertSame($client->id()->value, $id->value);
    }

    private function createClientDetails(): ClientDetails
    {
        $clientData = ClientFixture::CLIENTS[0];

        $name = new Name($clientData['firstName'], $clientData['lastName']);
        $address = new Address($clientData['city'], $clientData['state'], $clientData['zip']);
        $fico = new FICO($clientData['fico']);
        $contacts = new Contacts($clientData['email'], $clientData['phone']);
        $ssn = new SSN($clientData['ssn']);

        return new ClientDetails(
            name: $name,
            age: $clientData['age'],
            address: $address,
            ssn: $ssn,
            fico: $fico,
            contacts: $contacts
        );
    }
}
