<?php

declare(strict_types=1);

namespace App\Clients\Domain;

use App\Clients\Domain\ValueObject\ClientDetails;
use App\Shared\Domain\Model\AggregateRoot;
use App\Shared\Domain\ValueObject\Uuid;

class Client extends AggregateRoot
{
    public function __construct(
        private readonly Uuid $id,
        private readonly ClientDetails $details,
    ) {
    }

    public function id(): Uuid
    {
        return $this->id;
    }

    public function details(): ClientDetails
    {
        return $this->details;
    }
}
