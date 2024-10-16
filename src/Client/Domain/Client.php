<?php
declare(strict_types=1);

namespace App\Client\Domain;

use App\Client\Domain\ValueObject\ClientDetails;
use App\Common\Domain\Model\AggregateRoot;
use App\Common\Domain\ValueObject\Uuid;

class Client extends AggregateRoot
{
    public function __construct(
        private readonly Uuid $id,
        private readonly ClientDetails $details,
    )
    {
    }

    public static function create(ClientDetails $details): Client
    {
        return new self(Uuid::generate(), $details);
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