<?php

declare(strict_types=1);

namespace App\Clients\Presentation\Rest;

use App\Clients\Domain\ValueObject\Address;
use App\Shared\Domain\Enum\State;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

final readonly class RegisterClientRequestAddress
{
    public function __construct(
        #[NotBlank]
        public string $city,
        #[NotBlank]
        #[Choice(callback: [State::class, 'cases'])]
        public string $state,
        #[Regex('/^\d{5}(-\d{4})?$/')]
        public string $zip
    ) {
    }

    public function toDomainValue(): Address
    {
        return new Address(
            city: $this->city,
            state: $this->state,
            zip: $this->zip,
        );
    }
}
