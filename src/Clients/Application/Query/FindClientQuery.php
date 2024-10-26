<?php

declare(strict_types=1);

namespace App\Clients\Application\Query;

use App\Shared\Domain\Bus\Query\Query;
use App\Shared\Domain\ValueObject\Uuid;

final readonly class FindClientQuery implements Query
{
    public function __construct(public ?Uuid $id = null, public ?string $email = null)
    {
    }
}
