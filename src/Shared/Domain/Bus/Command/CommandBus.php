<?php

declare(strict_types=1);

namespace App\Shared\Domain\Bus\Command;

interface CommandBus
{
    public function execute(Command $command): void;
}
