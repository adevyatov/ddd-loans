<?php

declare(strict_types=1);

namespace App\Clients\Application\Command;

use App\Clients\Domain\ValueObject\ClientDetails;
use App\Shared\Domain\Bus\Command\Command;
use App\Shared\Domain\ValueObject\Uuid;

final readonly class RegisterClientCommand implements Command
{
    public function __construct(public Uuid $id, public ClientDetails $details)
    {
    }
}
