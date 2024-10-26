<?php

declare(strict_types=1);

namespace App\Clients\Presentation\Rest;

use App\Clients\Domain\ValueObject\ClientDetails;
use App\Clients\Domain\ValueObject\Contacts;
use App\Clients\Domain\ValueObject\FICO;
use App\Clients\Domain\ValueObject\Name;
use App\Clients\Domain\ValueObject\SSN;
use Symfony\Component\HttpKernel\Attribute\MapRequestPayload;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\GreaterThanOrEqual;
use Symfony\Component\Validator\Constraints\LessThanOrEqual;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

final readonly class RegisterClientRequest
{
    public function __construct(
        #[Email]
        public string $email,
        #[NotBlank]
        public string $firstName,
        #[NotBlank]
        public string $lastName,
        #[Regex("/^1\d{10}$/")]
        public string $phone,
        #[GreaterThanOrEqual(18)]
        public int $age,
        #[MapRequestPayload]
        public RegisterClientRequestAddress $address,
        #[GreaterThanOrEqual(300)]
        #[LessThanOrEqual(850)]
        public int $fico,
        #[Regex('/^(?!666|000|9\d{2})\d{3}-(?!00)\d{2}-(?!0000)\d{4}$/')]
        public string $ssn,
    ) {
    }

    public function toDomainValue(): ClientDetails
    {
        return new ClientDetails(
            name: new Name(
                firstName: $this->firstName,
                lastName: $this->lastName,
            ),
            age: $this->age,
            address: $this->address->toDomainValue(),
            ssn: new SSN($this->ssn),
            fico: new FICO($this->fico),
            contacts: new Contacts(
                email: $this->email,
                phone: $this->phone,
            ),
        );
    }
}
