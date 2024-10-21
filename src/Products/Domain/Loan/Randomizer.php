<?php

declare(strict_types=1);

namespace App\Products\Domain\Loan;

interface Randomizer
{
    public function random(int $min, int $max): int;
}
