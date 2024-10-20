<?php
declare(strict_types=1);

namespace App\Clients\Application\Command;

use App\Clients\Domain\ValueObject\Address;
use App\Clients\Domain\ValueObject\Contacts;
use App\Clients\Domain\ValueObject\FICO;
use App\Clients\Domain\ValueObject\Name;
use App\Clients\Domain\ValueObject\SSN;
use App\Shared\Domain\Bus\Command\Command;
use App\Shared\Domain\ValueObject\Uuid;

final readonly class UpdateClientDetailsCommand implements Command
{
    public function __construct(
        public Uuid $id,
        public ?Address $address,
        public ?int $age,
        public ?Contacts $contacts,
        public ?FICO $fico,
        public ?Name $name,
        public ?SSN $ssn,
    )
    {
    }
}