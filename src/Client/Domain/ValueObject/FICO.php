<?php
declare(strict_types=1);

namespace App\Client\Domain\ValueObject;

use Webmozart\Assert\Assert;

final readonly class FICO
{
    public function __construct(public int $value)
    {
        $this->validate();
    }

    private function validate(): void
    {
        Assert::greaterThanEq($this->value, 300, 'Credit score cannot be less than 300');
        Assert::lessThanEq($this->value, 850, 'Credit score cannot be greater than 850');
    }
}