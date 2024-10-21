<?php
declare(strict_types=1);

namespace App\Products\Domain;

use App\Shared\Domain\Enum\State;
use App\Shared\Domain\ValueObject\Uuid;

readonly class Client
{
    public function __construct(
        public Uuid $id,
        public int $fico,
        public int $age,
        public State $state,
    )
    {
    }
}