<?php
declare(strict_types=1);

namespace App\Product\Domain;

abstract class BaseProduct
{
    abstract public static function name(): string;
}