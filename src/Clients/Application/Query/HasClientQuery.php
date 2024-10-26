<?php

declare(strict_types=1);

namespace App\Clients\Application\Query;

use App\Shared\Domain\Bus\Query\Query;

final readonly class HasClientQuery implements Query
{
    public function __construct(public string $email)
    {
    }
}
