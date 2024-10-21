<?php

declare(strict_types=1);

namespace App\Products\Domain;

use App\Shared\Domain\Model\AggregateRoot;

abstract class BaseProduct extends AggregateRoot
{
    abstract public static function name(): string;
}
