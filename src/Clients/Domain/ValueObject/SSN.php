<?php

declare(strict_types=1);

namespace App\Clients\Domain\ValueObject;

use Webmozart\Assert\Assert;

final readonly class SSN
{
    public string $value;

    public function __construct(string $ssn)
    {
        $this->value = trim($ssn);

        $this->validate();
    }

    private function validate(): void
    {
        Assert::regex($this->value, '/^(?!666|000|9\d{2})\d{3}-(?!00)\d{2}-(?!0000)\d{4}$/', 'SSN must be valid');
    }
}
