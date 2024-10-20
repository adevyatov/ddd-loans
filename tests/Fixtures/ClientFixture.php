<?php
declare(strict_types=1);

namespace DataFixtures;

use App\Clients\Domain\Model\Client;
use App\Clients\Domain\ValueObject\Address;
use App\Clients\Domain\ValueObject\ClientDetails;
use App\Clients\Domain\ValueObject\Contacts;
use App\Clients\Domain\ValueObject\FICO;
use App\Clients\Domain\ValueObject\Name;
use App\Clients\Domain\ValueObject\SSN;
use App\Shared\Domain\Enum\States;
use App\Shared\Domain\ValueObject\Uuid;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class ClientFixture extends Fixture
{
    public const string REFERENCE = 'client';

    /**
     * @psalm-property array{
     *     id: string,
     *     firstName: string,
     *     lastName: string,
     *     city: string,
     *     state: string,
     *     zip: string,
     *     fico: int,
     *     email: string,
     *     phoneNumber: string,
     *     ssn: string,
     * }[]
     */
    public const array CLIENTS = [
        [
            'id' => '6ba7c983-3cf1-4eba-b3ee-03375dd2665f',
            'firstName' => 'John',
            'lastName' => 'Doe',
            'age' => 20,
            'city' => 'New York',
            'state' => States::NewYork->value,
            'zip' => '40202',
            'fico' => 500,
            'email' => 'john.doe@example.com',
            'phoneNumber' => '11234567890',
            'ssn' => '123-45-6789',
        ]
    ];

    public function load(ObjectManager $manager): void
    {
        foreach (self::CLIENTS as $key => $client) {
            $name = new Name($client['firstName'], $client['lastName']);
            $address = new Address($client['city'], $client['state'], $client['zip']);
            $fico = new FICO($client['fico']);
            $contacts = new Contacts($client['email'], $client['phoneNumber']);
            $ssn = new SSN($client['ssn']);

            $details = new ClientDetails(
                name: $name,
                age: $client['age'],
                address: $address,
                ssn: $ssn,
                fico: $fico,
                contacts: $contacts
            );

            $client = new Client(Uuid::generate(), $details);

            $manager->persist($client);
            $this->addReference(self::REFERENCE . $key, $client);
        }

        $manager->flush();
    }
}