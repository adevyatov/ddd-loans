<?php

declare(strict_types=1);

namespace App\Products\Infrastructure;

use App\Products\Domain\Loan\Randomizer;

use function random_int;

class SimpleRandomizer implements Randomizer
{
    public function random(int $min, int $max): int
    {
        return random_int($min, $max);
    }
}
